package com.example.joser.liceoelroblev02;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import android.widget.LinearLayout;
import android.widget.ScrollView;

import org.json.JSONArray;
import org.json.JSONObject;

import Controlador.ControladorBD;
import Controlador.ContruccionFrameDinamico;
import Model.ObtencionDatosWeb;

public class Suscripciones extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_suscripciones);

        try {
            ScrollView sv = new ScrollView(this);

            ContruccionFrameDinamico cfd = new ContruccionFrameDinamico(getApplicationContext());
            LinearLayout llNuevo = cfd.actualizarContenido();
            //llNuevo.setBackgroundColor(android.R.color.holo_blue_dark);
            if (llNuevo != null) {
                sv.addView(llNuevo);
                this.setContentView(sv);
            }/**/
        /*    ControladorBD bd = new ControladorBD();
            JSONObject jo = new JSONObject();
            jo.put("Seccion", " 7-1");
            JSONArray ja = new JSONArray();
            ja.put(jo);
            JSONObject jo2 = new JSONObject();
            jo2.put("Seccion", " 11-3");
            ja.put(jo2);
            JSONObject mainObj = new JSONObject();
            mainObj.put("Secciones", ja);

           bd.escribirLinea(getApplication(),mainObj.toString());
            String ret = bd.getTexto(getApplicationContext());
            ObtencionDatosWeb.mostrarTexto(getApplicationContext(),ret);/**/
        }
        catch(Exception e){
            ObtencionDatosWeb.mostrarTexto(getApplicationContext(),"Error"+e.getMessage()+e.getLocalizedMessage());

        }
    }
}
