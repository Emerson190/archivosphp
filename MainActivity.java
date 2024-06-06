package com.example.pruebaparcial03;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import org.json.JSONObject;
import org.w3c.dom.Document;
import org.w3c.dom.Node;
import android.os.StrictMode;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.annotation.SuppressLint;
@SuppressLint("NewApi")
public class MainActivity extends AppCompatActivity{
    TextView indicaciones;
    EditText entradaId, entradaNombre, entradaCosto, entradaPrecio;
    TextView salidalocalNb;
    TextView salidalocal;
    TextView salidapublicaues;
    TextView salidaHost;
    Button BotonLocalNb;
    Button BotonActualizar;
    Button BotonHosting;
    Button BotonConsultar;
    //para Java
    private static String urlConsulta = "http://192.168.0.11/ws_menor_costo.php";
    private static String urlActualizar1 = "http://192.168.0.11/ws_actualizar_nombre?nomproducto=";
    private static String urlActualizar2 = "&idproducto=";

    @SuppressLint("NewApi")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        //Lineas de codigo solo para depuracion.
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);
        indicaciones = (TextView) findViewById(R.id.textInidicaciones);
        entradaId = (EditText) findViewById(R.id.editId);
        entradaNombre = (EditText) findViewById(R.id.editNombre);
        salidalocal = (TextView) findViewById(R.id.textSalidaLocal);
        BotonActualizar=(Button) findViewById(R.id.ButtonActualizar);
        BotonConsultar=(Button) findViewById(R.id.ButtonConsulta);
        BotonActualizar.setOnClickListener(onClick);
        BotonConsultar.setOnClickListener(onClick);
    }
    View.OnClickListener onClick=new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            // TODO Auto-generated method stub
            if (v.getId()==R.id.ButtonActualizar){
                actualizarDatos();
            }
            if (v.getId()==R.id.ButtonConsulta){
                obtenerDatosLocal();
            }
        }
    };

    public void obtenerDatosLocal() {
        Controlador parser = new Controlador();
        String dato = entradaId.getText().toString();
        String url = urlConsulta;
        String json = parser.obtenerRespuestaDeURL(url,getApplicationContext());
        try {
            JSONObject obj = new JSONObject(json);
            salidalocal.setText(obj.getString("salida"));
        } catch (Exception e) {
            salidalocal.setText(Controlador.informacionError);
        }
    }

    public void actualizarDatos() {
        Controlador parser = new Controlador();
        String dato1 = entradaNombre.getText().toString();
        String dato2 = entradaId.getText().toString();
        String url = urlActualizar1 + dato1 + urlActualizar2 + dato2;
        String json = parser.obtenerRespuestaDeURL(url,getApplicationContext());
        try {
            JSONObject obj = new JSONObject(json);
            salidalocal.setText("Resultado de servicio local: "+obj.getString("nombre"));
        } catch (Exception e) {
            salidalocal.setText(Controlador.informacionError);
        }
    }
}
