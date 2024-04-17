@extends('layouts.app')

@section('content')
<style>
  
    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) translateY(-100%);  
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        z-index: 9999;
        opacity: 0;  
        transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out; 
    }

   
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);  
        z-index: 9998;  
        display: none;  
    }

     .popup-content {
        text-align: center;
    }

     .btn-ok {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

     .btn-ok:hover {
        background-color: #45a049;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Welcome To My Task</h2>
                </div>
                <div class="card-body">
                    <p class="lead text-center">Thank you for visiting. I'm excited to have you here!</p>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary" id="openPopup">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="popup" id="popup">
                <div class="popup-content">
                    <h2>Note</h2>
                    <p>Please choose a page from the navbar</p>
                    <button class="btn btn-ok" id="closePopup">OK</button>  
                </div>
            </div>
            <div class="overlay" id="overlay"></div>
        </div>
    </div>
</div>

<script>
     document.getElementById("openPopup").addEventListener("click", function(event) {
        event.preventDefault(); 
        document.getElementById("popup").style.display = "block"; 
        document.getElementById("overlay").style.display = "block";  
        setTimeout(function() {
            document.getElementById("popup").style.transform = "translate(-50%, -50%) translateY(0)";  
            document.getElementById("popup").style.opacity = "1";  
        }, 50);  
    });

    document.getElementById("closePopup").addEventListener("click", function(event) {
        event.preventDefault(); 
        document.getElementById("popup").style.transform = "translate(-50%, -50%) translateY(-100%)";  
        document.getElementById("popup").style.opacity = "0";  
        setTimeout(function() {
            document.getElementById("popup").style.display = "none";  
            document.getElementById("overlay").style.display = "none";  
        }, 300); 
    });
</script>
@endsection
