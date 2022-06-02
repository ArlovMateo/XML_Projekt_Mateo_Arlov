<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0 auto;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #D3D0CB;
        }
        .wrap {
            width: 50%;
        }
        header,footer {
            width: 100%;
            background-color: #2E5266;
            color: white;
            text-align: center;
            position: fixed;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
        }
        header {
            top: 0;
        }
        footer {
            bottom: 0;
        }
        main {
        padding: 50px 0px 400px 0px;
        background-color: white;
        text-align: center;
        }
        h1,h2,p {
            padding: 0;
            margin: 10px;
        }
        h1 {
            font-size: xx-large;
        }
        h2 {
            font-size: x-large;
        }
        p {
            font-size: large;
            font-weight: bold;
            text-align: left;
        }
        div {
            text-align: left;
            display: inline-block;
            align-items: center;
        }
        form {
            padding: 0px 200px;
        }
        form select {
            font-weight: normal;
            width: 185px;
            text-align: center;
            cursor: pointer;
        }
        button {
            font-weight: bold;
            padding: 5px;
            width: 150px;
            cursor: pointer;
            color: black;
            background-color: white;
            border: 3px solid #2E5266;
            border-radius: 50px;
            transition-duration: 0.5s;
            position: absolute;
            top: 450px;
        }
        .spremi {
            left: 795px;
        }
        .prikazi {
            right: 795px;
        }
        button:hover {
            background-color: #2E5266;
            color: white;
        }
    </style>
</head>
<body>
    <header class="wrap">
        <h1>XML Projekt</h1>
        <h1>2021./2022.</h1>
    </header>
    <main class="wrap">
        <br>
        <h2>Upitnik o studentu</h2>
        <form action="XML_Projekt_Mateo_Arlov.php" method="post">

            <p>Osobni podaci:</p>
            <input type="text" name="ime" title="Unesite svoje ime." placeholder="Ime">
                <br>
            <input type="text" name="prezime" title="Unesite svoje prezime." placeholder="Prezime">
                <br>
            <input type="email" name="email" title="Unesite svoju e-mail adresu." placeholder="Unesite e-mail adresu">
                <br>
            <input type="number" name="jmbg" title="Unesite svoj JMBG." placeholder="JMBG">
                <br>

            <p>Podaci o studiranju:</p>
            <label for="studij"><b>Studij:</b></label>
            <input type="radio" name="studij" id="redovni" value="Redovni">
            <label for="studij">Redovni</label>
            
            <input type="radio" name="studij" id="izvanredni" value="Izvanredni">
            <label for="studij">Izvanredni</label>
                <br>

            <label for="semestar"><b>Semestar:</b></label>
            <select name="semestar">
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
                <option value="VI">VI</option>
            </select>
                <br><br>
            <button type="spremi_xml" name="spremi_xml" class="spremi">Spremi XML</button>
                <br>
        </form>
            <br>
        <button type="prikazi_xml" name="prikazi_xml" class="prikazi" onclick="loadXML()">Prikaži XML</button>
        <br><br>
       <div id="prikazXML"></div>
       <script type="text/javascript">

            //Funkcija koja učitava XML i poziva ispis
            function loadXML() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                ispisiXML(this);
                }
            };
            xmlhttp.open("GET", "student_podaci.xml", true);
            xmlhttp.send();
            }

            //Funkcija koja ispisuje XML
            function ispisiXML(xml) {
            var i;
            var xmlDoc = xml.responseXML;
            var ispis="<hr><br><b>Podaci o studentu:</b><br><br>";
            var x = xmlDoc.getElementsByTagName("Student");
            for (i = 0; i <x.length; i++) { 

                ispis +="Ime: " +
                x[i].getElementsByTagName("ImeStudenta")[0].childNodes[0].nodeValue +
                "<br>" +

                "Prezime: " +
                x[i].getElementsByTagName("PrezimeStudenta")[0].childNodes[0].nodeValue +
                "<br>" +

                "Email: " +
                x[i].getElementsByTagName("Email")[0].childNodes[0].nodeValue +
                "<br>" +

                "JMBG: " +
                x[i].getElementsByTagName("JMBG")[0].childNodes[0].nodeValue +
                "<br>" +

                "Studij: " +
                x[i].getElementsByTagName("Studij")[0].childNodes[0].nodeValue +
                "<br>" +

                "Semestar: " +
                x[i].getElementsByTagName("Semestar")[0].childNodes[0].nodeValue;
            }
            document.getElementById("prikazXML").innerHTML = ispis;
            }
            </script>
    <!--Prikaz XML-a -->
    <?php
        if(isset($_POST['spremi_xml'])){
            //Osobni podaci
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $mail = $_POST['email'];
            $jmbg = $_POST['jmbg'];

            //Podaci o studiranju
            $studij = $_POST['studij'];
            $semestar = $_POST['semestar'];

            //Spremanje u XML datoteku
            $rezultat = '';
            $rezultat .= "<Student>\n";

            $rezultat .= "<OsobniPodaci>\n";
            $rezultat .= '<ImeStudenta>' . $ime . "</ImeStudenta>\n";
            $rezultat .= '<PrezimeStudenta>' . $prezime . "</PrezimeStudenta>\n";
            $rezultat .= '<Email>' . $mail . "</Email>\n";
            $rezultat .= '<JMBG>' . $jmbg . "</JMBG>\n";
            $rezultat .= "</OsobniPodaci>\n";

            $rezultat .= "<Podaci_o_studiranju>\n";
            $rezultat .= '<Studij>' . $studij . "</Studij>\n";
            $rezultat .= '<Semestar>' . $semestar . "</Semestar>\n";
            $rezultat .= "</Podaci_o_studiranju>\n";

            $rezultat .= '</Student>';

            $ime_datoteke = 'student_podaci' . '.xml';
            file_put_contents($ime_datoteke, $rezultat);
        }
    ?>

    </main>

    <footer class="wrap">
        <h2>Mateo Arlov</h2>
        <h2>0119038394</h2>
        <h2>marlov@tvz.hr</h2>
    </footer>
        
</body>
</html>