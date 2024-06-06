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
