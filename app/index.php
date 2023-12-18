<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Translator API</title>
    <style>
        html {
            background: linear-gradient(to right, mediumpurple, dodgerblue);
        }
       #userInput {
           border: 3px solid black;
           margin-top: 50px;
           width: 300px;
           height: 75px;
           background-color: transparent;
       }
       #languages{
           height: 30px;
           margin-top: 50px;
           border: 3px solid black;
           border-radius: 50px;
           background-color: tomato;
       }
       #heading {
           font-size: 100px;
           color: black;
           text-align: center;
       }
       #dropdown {
           font-size: 30px;
           color: tomato;
           height: 10px;
       }
       #userOutput {
           background-color: transparent;
           border: 3px solid black;
           margin-top: 50px;
       }
       #userInput, #userOutput {
           width: 300px;
           height: 75px;
           overflow-y: hidden;
           resize: none;
           margin-left: 0px;
           margin-bottom: 0px;
       }
       #translating {
           font-size: 25px;
           text-align: center;
           margin-top: 50px;
           margin-right: 40px;
       }
       #translated {
           font-size: 25px;
           text-align: center;
           margin-top: 50px;
           margin-right: 40px;
       }
       .dropdown {
          text-align: center;
       }
       .input-text {
           display: flex;
           align-items: center;
       }
       .output-text {
           display: flex;
           align-items: center;
           margin-left: 1250px;
       }
       #button {
           font-size: 20px;
           margin-left: 40px;
           background-color: tomato;
           margin-top: 50px;
       }
        .input-output-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        .input-text, .output-text {
            margin: 20px;
            flex: 1;
        }
        #footer {
            margin-top: 350px;
            text-align: center;
        }
    </style>
</head>
<header>
    <h1 id="heading">Fun Translations API</h1>
</header>
<body>
<div class="dropdown">
<label for="languages" id="dropdown">Select a Language to Translate to:</label>
<select id="languages" name="languages">
    <option value="minion">Minion</option>
    <option value="morse">Morse Code</option>
    <option value="pirate">Pirate</option>
    <option value="mandalorian">Mandalorian</option>
</select>
</div>
<br>
<div class="input-output-container">
    <div class="input-text">
        <label for="userInput" id="translating"><b>Enter Text to be Translated:</b></label>
        <textarea id="userInput" name="userInput" oninput="autoExpand(this)"></textarea>
        <button onclick="translateText()" id="button">Translate</button>
    </div>

    <div class="output-text">
        <label for="userOutput" id="translated"><b>Translated Text:</b></label>
        <textarea id="userOutput" name="userOutput" readonly></textarea>
    </div>
</div>
<footer id="footer">&copy;Daniel Manelis, Wei Wu, Eniola Orehin 2023</footer>
<script>
    function autoExpand(element) {
        element.style.height = 'inherit';
        var computed = window.getComputedStyle(element);
        var height = parseInt(computed.getPropertyValue('border-top-width'), 10)
            + parseInt(computed.getPropertyValue('padding-top'), 10)
            + element.scrollHeight
            + parseInt(computed.getPropertyValue('padding-bottom'), 10)
            + parseInt(computed.getPropertyValue('border-bottom-width'), 10);

        element.style.height = height + 'px';
    }
    function translateText() {
        var language = document.getElementById("languages").value;
        var text = document.getElementById("userInput").value;
        var apiUrl = `https://api.funtranslations.com/translate/${language}.json?text=${encodeURIComponent(text)}`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("userOutput").value = data.contents.translated;
                } else {
                    document.getElementById("userOutput").value = "Error in translation";
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById("userOutput").value = "Translation service is unavailable";
            });
    }
</script>
</body>
</html>

