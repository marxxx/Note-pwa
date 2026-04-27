<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
       /* Body styles for centering the card */
body {
    font-family: sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f0f0f0;
}

/* The main card container */
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    max-width: 300px;
    margin: auto;
    text-align: center;
    transition: 0.3s; /* Smooth transition for the hover effect */
    border-radius: 5px; /* Rounded corners for the card */
    background-color: white;
}
.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
    padding: 20px;
}

h4 {
    font-size: 35;
    color: #18b4f1;
    margin-top: 0;
    margin-bottom: 5px;
}

/* Title/designation styling */
p {
    color: grey;
    font-size: 20px;
    margin-top: 0;
    margin-bottom: 15px;
}

/* Button styling */
button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 10px 15px;
    color: white;
    /* background-color: #000; */
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
    border-radius: 4px;
}

button:hover {
    opacity: 0.7;
}

.back-btn{
  width: 25%;
  padding: 8px;
  /* background-color: #007bff; */
  color: #007bff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
  position: absolute;
  top: 20px;
  left: 8px;
}

/* .back-btn:hover {
  background-color: #0056b3;
} */


    </style>
</head>
<body>
    
<a href="{{ route('/') }}" class="back-btn"><button class="back-btn">Back</button></a>
<div class="card">

        <div class="container">
            <h4><b>JOHN MARK D. GODEZ</b></h4>
            <p>BSIT 3B</p>
        </div>
</div>

</body>
</html>