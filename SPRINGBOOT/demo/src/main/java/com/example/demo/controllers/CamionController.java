package com.example.demo.controllers;

import java.sql.*;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;

@RestController
@RequestMapping("/terminal") //127.0.0.1:8080/terminal
public class CamionController {

    final String DB_URL = "jdbc:mysql://127.0.0.1/inftec";
	final String USER = "root";
	final String PASS = "";
	private ObjectMapper mapper=new ObjectMapper();

    @GetMapping("/addCamion.php")
	public ObjectNode addCamion(@RequestParam String targa, @RequestParam int idUtente){
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "INSERT INTO camion (targa, id_cliente) VALUES (?, ?)";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setString(1, targa);
            ris.setInt(2, idUtente);
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

	@GetMapping("/getCamionByCliente.php")
	public ObjectNode getCamionByCliente(@RequestParam int idUtente) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT targa FROM camion WHERE id_cliente=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setInt(1, idUtente);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("camion");			
			while(row.next()){
				String targa=row.getString("targa");
				array.add(targa);

			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}
}
