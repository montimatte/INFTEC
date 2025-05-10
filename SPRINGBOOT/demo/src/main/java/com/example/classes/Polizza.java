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

    public void setId(int id) {
        this.id = id;
    }

    public int getId_viaggio() {
        return id_viaggio;
    }

    public void setId_viaggio(int id_viaggio) {
        this.id_viaggio = id_viaggio;
    }

    public String getTipologiaMerce() {
        return tipologiaMerce;
    }

    public void setTipologiaMerce(String tipologiaMerce) {
        this.tipologiaMerce = tipologiaMerce;
    }

    public double getPeso() {
        return peso;
    }

    public void setPeso(double peso) {
        this.peso = peso;
    }

    public String getFornitore() {
        return fornitore;
    }

    public void setFornitore(String fornitore) {
        this.fornitore = fornitore;
    }

    public int getGiorniMagazzinaggio() {
        return giorniMagazzinaggio;
    }

    public void setGiorniMagazzinaggio(int giorniMagazzinaggio) {
        this.giorniMagazzinaggio = giorniMagazzinaggio;
    }

    public double getTariffa() {
        return tariffa;
    }

    public void setTariffa(double tariffa) {
        this.tariffa = tariffa;
    }
}
