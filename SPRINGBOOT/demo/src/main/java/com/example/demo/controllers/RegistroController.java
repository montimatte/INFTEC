package com.example.demo.controllers;

import java.sql.*;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.classes.Registro;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;

@RestController
@RequestMapping("/terminal") //127.0.0.1:8080/terminal
public class RegistroController {

    final String DB_URL = "jdbc:mysql://127.0.0.1/inftec";
	final String USER = "root";
	final String PASS = "";
	private ObjectMapper mapper=new ObjectMapper();
    
    @GetMapping("/registraRitiro.php")
	public ObjectNode registraRitiro(@RequestParam int idBuono) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "INSERT INTO registro (id_buono) VALUES (?)";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, idBuono);
            ris.executeUpdate();

			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", "OK");
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;

        }
	}

	@GetMapping("/getRecord.php")
	public ObjectNode getRecord(){
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM registro JOIN buono ON registro.id_buono=buono.id JOIN utente u1 ON u1.id=buono.id_cliente JOIN polizza ON polizza.id=buono.id_polizza JOIN ritirante ON ritirante.id=buono.id_ritirante JOIN utente u2 ON u2.id=ritirante.id_conducente WHERE buono.stato=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setString(1, "usato");
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("record");			
			while(row.next()){
				int id=row.getInt("buono.id");
				String cliente=row.getNString("u1.username");
				int id_polizza=row.getInt("buono.id_polizza");
				String merce=row.getString("polizza.tipologiaMerce");
				double peso=row.getDouble("buono.peso");
				String targa=row.getString("ritirante.id_camion");
				String autotrasportatore=row.getString("u2.username");
				String data=row.getDate("registro.dataOraRitiro").toString();
				String ora=row.getTime("registro.dataOraRitiro").toString();

				String dataOra=data + " " + ora;
				Registro r=new Registro(id,cliente,peso,id_polizza,merce,targa,autotrasportatore,dataOra);
				array.addPOJO(r);
			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}	
}
