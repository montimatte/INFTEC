package com.example.classes;

public class Buono {
    private int id;
    private String cliente;
    private int id_ritirante;
    private String targa;
    private String autotrasportatore;
    private double peso;
    private int id_polizza;
    private String tipologiaMerce;
    private String stato;

    public Buono(int id, String cliente, int id_ritirante, double peso, int id_polizza, String tipologiaMerce, String stato, String targa, String autotrasportatore) {
        this.id = id;
        this.cliente = cliente;
        this.id_ritirante = id_ritirante;
        this.peso = peso;
        this.id_polizza = id_polizza;
        this.tipologiaMerce = tipologiaMerce;
        this.stato = stato;
        this.targa = targa;
        this.autotrasportatore = autotrasportatore;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getCliente() {
        return cliente;
    }

    public void setCliente(String cliente) {
        this.cliente = cliente;
    }

    public int getId_ritirante() {
        return id_ritirante;
    }

    public void setId_ritirante(int id_ritirante) {
        this.id_ritirante = id_ritirante;
    }

    public double getPeso() {
        return peso;
    }

    public void setPeso(double peso) {
        this.peso = peso;
    }

    public int getId_polizza() {
        return id_polizza;
    }

    public void setId_polizza(int id_polizza) {
        this.id_polizza = id_polizza;
    }

    public String getTipologiaMerce() {
        return tipologiaMerce;
    }

    public void setTipologiaMerce(String tipologiaMerce) {
        this.tipologiaMerce = tipologiaMerce;
    }

    public String getStato() {
        return stato;
    }

    public void setStato(String stato) {
        this.stato = stato;
    }

    public String getTarga() {
        return targa;
    }

    public void setTarga(String targa) {
        this.targa = targa;
    }

    public String getAutotrasportatore() {
        return autotrasportatore;
    }

    public void setAutotrasportatore(String autotrasportatore) {
        this.autotrasportatore = autotrasportatore;
    }
}
