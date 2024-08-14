                                                                                        
<div class="form">
    <h1 class="title">Registro de PQRS</h1>
    <form method="post" action="procesar_pqrs.php" enctype="multipart/form-data" id="form">
        <label for="nombre" class="label">Nombres:</label>
        <input class="input" type="text" id="nombre" name="nombre" required>
        <label for="apellido" class="label">Apellidos:</label>
        <input class="input" type="text" id="apellido" name="apellido" required>
        <label class="label" for="tipo_documento">Tipo de documento:</label>
        <select class="input" name="tipo_documento">
            <option value="cc">CC</option>
            <option value="ti">TI</option>
            <option value="ppt">PPT</option>
        </select>
        <label for="documento" class="label">Nr° documento:</label>
        <input class="input" type="number" id="documento" name="documento" min="2000000" max="2000000000" required>
        <label class="label" for="email">Correo electrónico:</label>
        <input class="input" type="email" id="email" name="email" required>
        <label class="label" for="cargo">Cargo:</label>
        <select class="input" name="cargo">
            <option value="estudiante">Estudiante</option>
            <option value="acudiente">Acudiente</option>
            <option value="docente">Docente</option>
            <option value="egresado">Egresado</option>
            <option value="prof_apoyo">Profesional de apoyo</option>
            <option value="auxiliar">Auxiliar</option>
        </select>
        <label class="label" for="tipo_pqrs">Tipo de PQRS:</label>
        <select class="input" name="tipo_pqrs">
            <option value="peticion">Petición</option>
            <option value="queja">Queja</option>
            <option value="reclamo">Reclamo</option>
            <option value="sugerencia">Sugerencia</option>
            <option value="felicitacion">Felicitación</option>
        </select>

        <label class="label" for="descripcion">Narre brevemente los hechos:</label>
        <textarea class="descr" name="descripcion" id="descripcion" rows="10"></textarea>

        <label class="label" for="archivo">Adjuntar archivo o imágen:</label>
        <div class="container-input">
            <input type="file" name="file" id="file" class="inputfile inputfile" accept="image/*,application/pdf" />
            <label for="file">
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                </figure>
            <span class="iborrainputfile"></span>
            </label>
            <div id="preview">
                
            </div>
        </div>
        <div class="auto">
            <input type="checkbox" name="confirmacion" class="autoriz" id="confir">
            <label for="confirmacion">Esta seguro(a) de enviar la información.</label> <br>
            <input type="checkbox"name="tratamiento"  class="autoriz" id="trata">
            <label for="tratamiento">Autoriza el tratamiento de datos segun la ley.</label> <br>
        </div>
        <input type="submit" value="Enviar PQRS">
    </form>
</div>
