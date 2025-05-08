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
	final String PASS = "";
	private ObjectMapper mapper=new ObjectMapper();

	public static void main(String[] args) {
		SpringApplication.run(DemoApplication.class, args);
	}

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

	@GetMapping("/getUtenteByRuolo.php")
	public ObjectNode getUtenteByRuolo(@RequestParam String ruolo) {

		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT id,username FROM utente WHERE ruolo=?";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setString(1, ruolo);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("users");			
			while(row.next()){
				int id=row.getInt("id");
				String un=row.getString("username");
				ObjectNode user=mapper.createObjectNode();
				user.put("id",id);
				user.put("username",un);
				array.add(user);
			}
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
	public ObjectNode inviaRichiestaBuono(@RequestParam int idUtente, @RequestParam int idRitirante, @RequestParam int idPolizza, @RequestParam double peso) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "INSERT INTO buono (id_cliente, id_ritirante, peso, id_polizza) VALUES (?, ?, ?, ?)";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, idUtente);
            ris.setInt(2, idRitirante);
            ris.setDouble(3, peso);
            ris.setInt(4, idPolizza);
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

	@GetMapping("/getBuoniUtente.php")
	public ObjectNode getBuoniUtente(@RequestParam int idUtente) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM buono JOIN utente ON utente.id=buono.id_cliente JOIN polizza ON polizza.id=buono.id_polizza WHERE buono.id_ritirante=? AND buono.stato=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setInt(1, idUtente);
			ris.setString(2, "accettato");
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("buoni");			
			while(row.next()){
				int id=row.getInt("buono.id");
				String cliente=row.getNString("utente.username");
				int id_polizza=row.getInt("buono.id_polizza");
				String merce=row.getString("polizza.tipologiaMerce");
				double peso=row.getDouble("buono.peso");

				ObjectNode buono=mapper.createObjectNode();
				buono.put("id", id);
				buono.put("cliente", cliente);
				buono.put("id_polizza", id_polizza);
				buono.put("tipologiaMerce", merce);
				buono.put("peso", peso);
				array.add(buono);

			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}
	
	@GetMapping("/getBuoniByStato.php")
	public ObjectNode getBuoniByStato(@RequestParam String stato) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM buono JOIN utente ON utente.id=buono.id_cliente JOIN polizza ON polizza.id=buono.id_polizza WHERE buono.stato=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setString(1, stato);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("buoni");			
			while(row.next()){
				int id=row.getInt("buono.id");
				String cliente=row.getNString("utente.username");
				int id_polizza=row.getInt("buono.id_polizza");
				String merce=row.getString("polizza.tipologiaMerce");
				double peso=row.getDouble("buono.peso");

				ObjectNode buono=mapper.createObjectNode();
				buono.put("id", id);
				buono.put("cliente", cliente);
				buono.put("id_polizza", id_polizza);
				buono.put("tipologiaMerce", merce);
				buono.put("peso", peso);
				array.add(buono);

			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}

	@GetMapping("/updateBuono.php")
	public ObjectNode updateBuono(@RequestParam int id, @RequestParam String stato) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
			String q = "UPDATE buono SET stato=? WHERE id=?";
			PreparedStatement ris = conn.prepareStatement(q);
			ris.setString(1, stato);
			ris.setInt(2, id);
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

	@GetMapping("/registraRitiro.php")
	public ObjectNode registraRitiro(@RequestParam int idRitirante, @RequestParam int idBuono) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "INSERT INTO registro (id_ritirante, id_buono) VALUES (?, ?)";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, idRitirante);
            ris.setInt(2, idBuono);
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

}
