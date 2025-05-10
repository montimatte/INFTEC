package com.example.demo.controllers;

import java.sql.*;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.classes.User;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;

@RestController
@RequestMapping("/terminal") //127.0.0.1:8080/terminal
public class UserController {

    final String DB_URL = "jdbc:mysql://127.0.0.1/inftec";
	final String USER = "root";
	final String PASS = "";
    private ObjectMapper mapper=new ObjectMapper();


    @GetMapping("/addUtente.php")
	public ObjectNode addUtente(@RequestParam String username, @RequestParam String password, @RequestParam String ruolo){
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "INSERT INTO utente (username,password,ruolo) VALUES (?, ?, ?)";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setString(1, username);
            ris.setString(2, password);
            ris.setString(3, ruolo);
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

	@GetMapping("/getUtente.php")
	public ObjectNode getUtente(@RequestParam String username, @RequestParam String password) {

		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM utente WHERE username=? AND password=?";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setString(1, username);
            ris.setString(2, password);
            ResultSet row=ris.executeQuery();
			row.next();

			int id=row.getInt("id");
			String un=row.getString("username");
			String pwd=row.getString("password");
			String ruolo=row.getString("ruolo");

			User u= new User(id,un,pwd,ruolo);

			ObjectNode obj=mapper.createObjectNode();
			obj.putPOJO("user", u);

			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}

	@GetMapping("/getUtenteByRuolo.php")
	public ObjectNode getUtenteByRuolo(@RequestParam String ruolo) {

		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT id,username FROM utente WHERE ruolo=?";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setString(1, ruolo);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("users");
			
			while (row.next()) {
				int id=row.getInt("id");
				String un=row.getString("username");
				User u=new User(id, un, "", "");
				array.addPOJO(u);
			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}
}
