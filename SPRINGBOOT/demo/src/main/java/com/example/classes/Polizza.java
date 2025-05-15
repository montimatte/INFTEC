package com.example.classes;

public class Polizza {
    private int id;
    private int id_viaggio;
    private String tipologiaMerce;
    private double peso;
    private String fornitore;
    private int giorniMagazzinaggio;
    private double tariffa;

    public Polizza(int id, int id_viaggio, String tipologiaMerce, double peso, String fornitore, int giorniMagazzinaggio, double tariffa) {
        this.id = id;
        this.id_viaggio = id_viaggio;
        this.tipologiaMerce = tipologiaMerce;
        this.peso = peso;
        this.fornitore = fornitore;
        this.giorniMagazzinaggio = giorniMagazzinaggio;
        this.tariffa = tariffa;
    }

    public int getId() {
        return id;
    }

    public int getId_viaggio() {
        return id_viaggio;
    }

    public String getTipologiaMerce() {
        return tipologiaMerce;
    }

    public double getPeso() {
        return peso;
    }

    public String getFornitore() {
        return fornitore;
    }

    public int getGiorniMagazzinaggio() {
        return giorniMagazzinaggio;
    }

    public double getTariffa() {
        return tariffa;
    }
}
