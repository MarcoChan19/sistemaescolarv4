
<DOCTYPE html>
    <html>
    <head>
      <link rel="stylesheet" href="node_modules\bulma\css\bulma.min.css">
      <script src="node_modules\axios\dist\axios.min.js"></script>
    </head>
      <body class="box" background="plantillas.jpg">
        <div >
          <form action="api/login" method="post">
              <div class="field">
                <input class="input" type="email"  placeholder="Email" id= 'usuario' name='usuario'>
              </div>

              <div class="field">
                <input class="input" type="password" placeholder="password" id='contraseña' name='contraseña'>
              </div>
              
              <div class= "field">
                <button class="button is-black" type="button" onclick="login()">Submit</button>
              </div>  
          </form>
        </div>

        <script>
          function login()
          {
            axios.post(`api/login/${document.forms[0].usuario.value}`, {
              usuario: document.forms[0].usuario.value,
              contraseña: document.forms[0].contraseña.value,
            }).then(resp => {
              if (resp.data.aceptado)
              {
                if (resp.data.usuarios)
                {
                  alert("aceptado") 
                  location.href='inicio.php';
                }
                else
                {
                  alert("aceptado administrador")
                  location.href='inicio.php';
                }
              }
              else
              {
                alert("no aceptado")
              }

            }).catch(error => {
              console.log(error)
            })
          }
      </script>
</body>
</html>