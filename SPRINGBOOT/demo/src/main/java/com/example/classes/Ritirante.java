package com.example.classes;

public class Ritirante {
    private String targa;
    private int idAutotrasportatore;
    private String autotrasportatore;
    private int id;

    public Ritirante(int id, String targa, int idAutotrasportatore, String autotrasportatore) {
        this.targa = targa;
        this.idAutotrasportatore = idAutotrasportatore;
        this.autotrasportatore = autotrasportatore;
        this.id=id;
    }

    public String getTarga() {
        return targa;
    }

    public void setTarga(String targa) {
        this.targa = targa;
    }

    public int getIdAutotrasportatore() {
        return idAutotrasportatore;
    }

    public void setIdAutotrasportatore(int idAutotrasportatore) {
        this.idAutotrasportatore = idAutotrasportatore;
    }

    public String getAutotrasportatore() {
        return autotrasportatore;
    }

    public void setAutotrasportatore(String autotrasportatore) {
        this.autotrasportatore = autotrasportatore;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
}
