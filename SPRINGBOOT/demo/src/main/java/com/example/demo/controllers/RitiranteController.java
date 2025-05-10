package com.example.demo.controllers;

import java.sql.*;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.classes.Ritirante;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;

@RestController
@RequestMapping("/terminal") //127.0.0.1:8080/terminal
public class RitiranteController {

    final String DB_URL = "jdbc:mysql://127.0.0.1/inftec";
	final String USER = "root";
	final String PASS = "";
	private ObjectMapper mapper=new ObjectMapper();

    @GetMapping("/addRitirante.php")
	public ObjectNode addRitirante(@RequestParam String idCamion, @RequestParam int idAutotrasportatore){
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "INSERT INTO ritirante (id_camion, id_conducente) VALUES (?,?)";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setString(1, idCamion);
            ris.setInt(2, idAutotrasportatore);
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

	@GetMapping("/getRitirantiByCliente.php")
	public ObjectNode getRitirantiByCliente(@RequestParam int idCLiente) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT ritirante.id, camion.targa, utente.id, utente.username AS autotrasportatore FROM ritirante JOIN camion ON camion.targa=ritirante.id_camion JOIN utente ON utente.id=ritirante.id_conducente WHERE camion.id_cliente=?";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, idCLiente);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("ritiranti");
			while (row.next()) {
				int id=row.getInt("ritirante.id");
				int idAut=row.getInt("utente.id");
				String aut=row.getString("autotrasportatore");
				String targa=row.getString("camion.targa");

				Ritirante r= new Ritirante(id,targa,idAut,aut);
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
