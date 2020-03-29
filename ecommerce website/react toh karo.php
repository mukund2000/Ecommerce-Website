<html>
<head>
    <title>Reaction Tester</title>
    <style type="text/css">
    
            
            body {
                
                font-family: sans-serif;
                background-image: url(gamer.jpg);
                background-size: cover;
                
            }
        
            #shape {
                
                width: 200px;
                height: 200px;
                background-color: red;
                display: none;
                position: relative;
                
            }
            
            .bold {
                
                font-weight: bold;
                
            }
        #text{
            color: red;
        }
    
    </style>
    </head>
    <body>
        <div id="text">
        <h1><center>Check your reaction!!</center></h1>
        <h3>Your time:<span id="timeTaken"></span></h3></div>
    <div id="shape"></div>
    
            <script type="text/javascript">
        
            var start = new Date().getTime();
            
            function getRandomColor() {
                
                var letters = '0123456789ABCDEF'.split('');
    
                var color = '#';
    
                for (var i = 0; i < 6; i++ ) {
        
                    color += letters[Math.floor(Math.random() * 16)];
    
                }
    
                return color;

            }
            
            function makeShapeAppear() {
                
                var top = Math.random() * 400;
                
                var left = Math.random() * 400;
                
                var width = (Math.random() * 200) + 100;
                
                if (Math.random() > 0.5) {
                    
                    document.getElementById("shape").style.borderRadius = "50%";
                    
                } else {
                    
                    document.getElementById("shape").style.borderRadius = "0";
                    
                }
                
                document.getElementById("shape").style.backgroundColor = getRandomColor();
                
                document.getElementById("shape").style.width = width + "px";
                
                document.getElementById("shape").style.height = width + "px";
                
                document.getElementById("shape").style.top = top + "px";
                
                document.getElementById("shape").style.left = left + "px";
    
                document.getElementById("shape").style.display = "block";
                
                start = new Date().getTime();

            }
            
            function appearAfterDelay() {
                
                setTimeout(makeShapeAppear, Math.random() * 2000);
                
            }
            
            appearAfterDelay();
            
            document.getElementById("shape").onclick = function() {
                
                document.getElementById("shape").style.display = "none";
                
                var end = new Date().getTime();
                
                var timeTaken = (end - start) / 1000;
                
                document.getElementById("timeTaken").innerHTML = timeTaken + "s";
                
                appearAfterDelay();
                
            }
            </script>
    </body>
</html>