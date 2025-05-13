package com.example.demo.controllers;

import java.sql.*;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.classes.Fattura;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;

@RestController
@RequestMapping("/terminal") //127.0.0.1:8080/terminal
public class FatturaController {

    final String DB_URL = "jdbc:mysql://127.0.0.1/inftec";
	final String USER = "root";
	final String PASS = "";
	private ObjectMapper mapper=new ObjectMapper();

    @GetMapping("/generaFattura.php")
	public ObjectNode generaFattura(@RequestParam int idBuono) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {

			//prendo id e data del ritiro dal registro
			String q="SELECT id,dataOraRitiro FROM registro WHERE id_buono=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setInt(1, idBuono);
            ResultSet row=ris.executeQuery();
			row.next();

			int idRegistro=row.getInt("id");
			Timestamp ritiro=row.getTimestamp("dataOraRitiro");


			//prendo la polizza, il peso e la data di approvazione dal buono
			q="SELECT id_polizza,peso,dataOraApprovazione FROM buono WHERE id=?";
			ris = conn.prepareStatement(q);
			ris.setInt(1, idBuono);
			row=ris.executeQuery();
			row.next();

			int idPolizza=row.getInt("id_polizza");
			double peso=row.getDouble("peso");
			Timestamp approvazione=row.getTimestamp("dataOraApprovazione");

			//prendo i giorni di magazzinaggio e la tariffa della polizza
			q="SELECT giorniMagazzinaggio,tariffa FROM polizza WHERE id=?";
			ris = conn.prepareStatement(q);
			ris.setInt(1, idPolizza);
			row=ris.executeQuery();
			row.next();

			int giorniMagazzinaggio=row.getInt("giorniMagazzinaggio");
			double tariffa=row.getDouble("tariffa");


			double tot=0;

			long diffInMillis = Math.abs(ritiro.getTime() - approvazione.getTime());
			long diffInDays = diffInMillis / (1000 * 60 * 60 * 24);

			if (diffInDays >= giorniMagazzinaggio) {
				tot=(peso/1000)*tariffa*diffInDays; //prezzo a tonnellata giornaliero
			}

			if(tot>0){
				q="INSERT INTO fattura (id_registro, importo) VALUES (?,?)";
            	ris = conn.prepareStatement(q);
				ris.setInt(1, idRegistro);
            	ris.setDouble(2, tot);
            	ris.executeUpdate();
			}

			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", "OK");
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}

    @GetMapping("/getFattureCliente.php")
    public ObjectNode getFattureCliente(@RequestParam int idCliente) {
        try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM fattura JOIN registro ON fattura.id_registro=registro.id JOIN buono ON registro.id_buono=buono.id JOIN polizza ON buono.id_polizza=polizza.id WHERE buono.id_cliente=?";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, idCliente);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("fatture");
			
			while (row.next()) {
				int id=row.getInt("fattura.id");
				double importo=row.getDouble("fattura.importo");
                int idBuono=row.getInt("buono.id");
                String merce=row.getString("polizza.tipologiaMerce");
                double peso=row.getDouble("buono.peso");
                Fattura f=new Fattura(id, importo, idBuono, merce, peso);
				array.addPOJO(f);
			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
    }
    
}
