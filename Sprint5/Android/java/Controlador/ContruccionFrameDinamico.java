package Controlador;

import android.content.Context;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.widget.CompoundButton;
import android.widget.LinearLayout;
import android.widget.ScrollView;
import android.widget.Switch;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.concurrent.ExecutionException;

import Model.BaseDeDatos;
import Model.ObtencionDatosWeb;

/**
 * Created by JoseR on 25/4/2017.
 */

public class ContruccionFrameDinamico {

    Context contexto;
    ArrayList<String> secc = new ArrayList<>();
    ArrayList<String> seccBD = new ArrayList<>();
    ControladorBD bd ;

    public ContruccionFrameDinamico(Context pContext) {
        contexto = pContext;
        bd = new ControladorBD(pContext);

    }


    public LinearLayout actualizarContenido() {
        ObtencionDatosWeb obtSec = new ObtencionDatosWeb();
        AsyncTask<String, Void, String> res = obtSec.execute(
                "http://liceoelroble.com/MODEL/SeccionesController.php?operacion=obtenerSecciones");
        String imp = "";

        String  Consulta  = bd.getTexto(contexto);

        try{
            JSONObject bdSecciones = new JSONObject(Consulta);
            for (int Item = 0; Item < bdSecciones.getJSONArray("Secciones").length(); Item++) {
                String seccion = bdSecciones.getJSONArray("Secciones").getJSONObject(Item).getString("Seccion");
                seccBD.add(seccion);
            }
        }
        catch (JSONException e) {

        }
        try {
            String ress = res.get();
            if(ress==""){
                return null;
            }

            //imp = ress.substring(1, ress.length() - 1);
            imp = "{Secciones:"+ress+"}";
            //ObtencionDatosWeb.mostrarTexto(contexto.getApplicationContext(),imp);
           // List<String> items = Arrays.asList(imp.split("\\s*,\\s*"));
            //----- Carga dinamica
            //ScrollView sv = new ScrollView(contexto);
            JSONObject json = new JSONObject(imp);
            final LinearLayout ll = new LinearLayout(contexto);

            ll.setOrientation(LinearLayout.VERTICAL);
            //sv.addView(ll);

            ArrayList<String> suscrito = new ArrayList<>();

            //Label lbl = new Labl();
            TextView susTxtVie = new TextView(contexto.getApplicationContext());
            susTxtVie.setText("Disponibles");
            susTxtVie.setTextSize((float) 30);
            ll.addView(susTxtVie);
            //ObtencionDatosWeb.mostrarTexto(contexto.getApplicationContext(),json.getJSONArray("Secciones").toString());

            for (int Item = 0; Item < json.getJSONArray("Secciones").length(); Item++) {
                //JSONObject json = new JSONObject(items.get(Item));
                //Log.i("Liceo responde:",json.toString());
                //obtencionDatosWeb.mostrarTexto(getApplicationContext(),json.getString("Seccion"));
                //Thread.sleep(4000);
                final String seccion = json.getJSONArray("Secciones").getJSONObject(Item).getString("Seccion");
                //ObtencionDatosWeb.mostrarTexto(contexto.getApplicationContext(),seccion);
                Switch sw = new Switch(contexto.getApplicationContext());
                sw.setText(seccion);
                sw.setTextSize((float) 25);
                if (seccBD.contains(seccion)) {

                    sw.setTag("NoSus");
                    sw.setChecked(true);


                }
                if (!seccBD.contains(seccion)) {
                    sw.setTag("Sus");
                    sw.setChecked(false);

                }
                ll.addView(sw);
                sw.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
                    public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                        if (isChecked) {
                            if (!seccBD.contains((String)buttonView.getText())) {
                                //long id = bd.insertarBD(bd, ((String) buttonView.getText()), contexto.getApplicationContext());
                                //ArrayList<String> secc2 = bd.SelectBD(bd);
                                seccBD.add((String) buttonView.getText());
                                guardarCambios();
                                ObtencionDatosWeb.mostrarTexto(contexto.getApplicationContext(), "Se ha suscrito a: " + buttonView.getText()/* + " ID:" + id*/);//+" -Seg "
                                // + secc2.size()+" -Prim "+secc.size());
                                //actualizarContenido();
                            } else {

                                ObtencionDatosWeb.mostrarTexto(contexto.getApplicationContext(), "Ya está suscrito a esta sección");
                            }
                        } else {
                            //bd.eliminarDato(bd, ((String) buttonView.getText()));
                            seccBD.remove((String)buttonView.getText());
                            guardarCambios();
                            ObtencionDatosWeb.mostrarTexto(contexto.getApplicationContext(), "Se ha dessuscrito a: " + buttonView.getText());
                            //actualizarContenido();
                        }
                        //obtencionDatosWeb.mostrarTexto(getApplicationContext(),buttonView.getText()+" "+isChecked);
                    }
                });/**/

            }
           /**/
            //http://stackoverflow.com/questions/13226353/android-checkbox-dynamically
            // cargar dinamicamente arr
            return ll;
        } catch (InterruptedException e) {
            imp = e.getMessage();
            ObtencionDatosWeb.mostrarTexto(contexto.getApplicationContext(), imp);
            return null;
        } catch (ExecutionException e) {
            imp = e.getMessage();
            ObtencionDatosWeb.mostrarTexto(contexto.getApplicationContext(), imp);
            return null;
        } catch (Exception e) {
            imp = e.getMessage();
            ObtencionDatosWeb.mostrarTexto(contexto.getApplicationContext(), imp);
            return null;
        }


    }

    private void guardarCambios(){

        try {
            JSONArray secciones = new JSONArray();

            for (int i = 0; i < seccBD.size(); i++) {
                JSONObject seccion = new JSONObject();
                seccion.put("Seccion", seccBD.get(i));
                secciones.put(seccion);
            }
            JSONObject Principal = new JSONObject();
            Principal.put("Secciones", secciones);
            bd.escribirLinea(contexto,Principal.toString());


        } catch (JSONException e) {
            ObtencionDatosWeb.mostrarTexto(contexto,"Ha sucedido un error al guardar los datos.");
        }

    }
}
