package com.example.demo;

import java.sql.*;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;


@SpringBootApplication
@RestController
@RequestMapping("/terminal") //127.0.0.1:8080/terminal
public class DemoApplication {

	final String DB_URL = "jdbc:mysql://127.0.0.1/inftec";
	final String USER = "root";
	final String PASS = "DELL-SRV2016";
	private ObjectMapper mapper=new ObjectMapper();

	public static void main(String[] args) {
		SpringApplication.run(DemoApplication.class, args);
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

			ObjectNode obj=mapper.createObjectNode();
			obj.put("id", id);
			obj.put("username", un);
			obj.put("password", pwd);
			obj.put("ruolo", ruolo);

			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}

	@GetMapping("/getPolizze.php")
	public ObjectNode getPolizze() {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM polizza";
            PreparedStatement ris = conn.prepareStatement(q);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("polizze");			
			while(row.next()){
				int id=row.getInt("id");
				int id_viaggio=row.getInt("id_viaggio");
				String tipologiaMerce=row.getString("tipologiaMerce");
				double peso=row.getDouble("peso");
				String fornitore=row.getString("fornitore");
				int giorniMagazzinaggio=row.getInt("giorniMagazzinaggio");
				double tariffa=row.getDouble("tariffa");

				ObjectNode polizza=mapper.createObjectNode();
				polizza.put("id", id);
				polizza.put("id_viaggio", id_viaggio);
				polizza.put("tipologiaMerce", tipologiaMerce);
				polizza.put("peso", peso);
				polizza.put("fornitore", fornitore);
				polizza.put("giorniMagazzinaggio", giorniMagazzinaggio);
				polizza.put("tariffa", tariffa);
				array.add(polizza);

			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}

	@GetMapping("/getPolizzaById.php")
	public ObjectNode getPolizzaById(@RequestParam int id) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM polizza WHERE id=?";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, id);
            ResultSet row=ris.executeQuery();
			row.next();

			int idd=row.getInt("id");
			int id_viaggio=row.getInt("id_viaggio");
			String tipologiaMerce=row.getString("tipologiaMerce");
			double peso=row.getDouble("peso");
			String fornitore=row.getString("fornitore");
			int giorniMagazzinaggio=row.getInt("giorniMagazzinaggio");
			double tariffa=row.getDouble("tariffa");

			ObjectNode polizza=mapper.createObjectNode();
			polizza.put("id", idd);
			polizza.put("id_viaggio", id_viaggio);
			polizza.put("tipologiaMerce", tipologiaMerce);
			polizza.put("peso", peso);
			polizza.put("fornitore", fornitore);
			polizza.put("giorniMagazzinaggio", giorniMagazzinaggio);
			polizza.put("tariffa", tariffa);

			return polizza;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}
	
	@GetMapping("/inviaRichiestaBuono.php")
	public ObjectNode inviaRichiestaBuono(@RequestParam int idUtente, @RequestParam int idPolizza, @RequestParam double peso) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "INSERT INTO buono (id_cliente, peso, id_polizza) VALUES (?, ?, ?)";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, idUtente);
            ris.setDouble(2, peso);
            ris.setInt(3, idPolizza);
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
}
