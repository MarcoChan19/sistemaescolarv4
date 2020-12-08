
<DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="node_modules\bulma\css\bulma.min.css">
    <script src="node_modules\axios\dist\axios.min.js"></script>
</head>
<body class="box" background="plantillas.jpg">
        <div>
            <form method='post' action='admin.php'>
                <div class="field">
                    <label class="label">inserte calificacion</label>
                    <div class="control">
                        <input class="input" type="text" name="calificacion">
                    </div>
                </div>

                <div class="control">
                    <button class="button is-black" type="button" onclick="ins()">Submit</button>
                </div>
                
            </form>
        </div>

    <script>
        function ins()
        {
            axios.post(`api/ins`, 
            {
              calificacion: document.forms[0].calificacion.value,
            }).then(resp => 
            {
              if (resp.data.calif)
              {
                alert("calificacion guardada");
                
              }
              else
              {
                alert("calificacion erronea");
                
              }

            }).catch(error => 
            {
              console.log(error)
            })
        }
    </script>

</body>
</html>