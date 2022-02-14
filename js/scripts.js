/* ***********************
PAGE: leads.single.php
*********************** */

    //Search for Company Link
    function showSuggestion(str){
        if(str.length == 0){
            document.getElementById('output').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('output').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "search.php?q="+str, true);
            xmlhttp.send();
        }
    }

    //Link LEAD to COMPANY
    function linkToCompany(int){
        if(int.length == 0){
            document.getElementById('companylink').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('companylink').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "link.lead.php?id=<?php echo $lead['id']; ?>&q="+int, true);
            xmlhttp.send();
        } window.location.reload(true);
    }

    //Link LEAD to PROJECT
    function linkToProject(int){
        if(int.length == 0){
            document.getElementById('projectlink').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('projectlink').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "link.leadtoproj.php?id=<?php echo $lead['id']; ?>&u="+int, true);
            xmlhttp.send();
        } window.location.reload(true);
    }

    //Contact Made Checkbox
    function checkboxContact(bool){
        if(bool.length == 0){
            document.getElementById('doneContact').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('doneContact').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "checkbox.contact.php?id=<?php echo $lead['id']; ?>&checkbox="+bool, true);
            xmlhttp.send();
        } window.location.reload(true);
    }

    //Opt Out Checkbox
    function checkboxOptOut(bool){
        if(bool.length == 0){
            document.getElementById('doneOptOut').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('doneOptOut').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "checkbox.optout.php?id=<?php echo $lead['id']; ?>&checkbox="+bool, true);
            xmlhttp.send();
        } window.location.reload(true);window.location.reload(true);
    }


/* ***********************
PAGE: projects.single.php
*********************** */

    //Link PROJECT to COMPANY
    function linkToCompany(int){
        if(int.length == 0){
            document.getElementById('companylink').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('companylink').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "link.project.php?id=<?php echo $project['id']; ?>&q="+int, true);
            xmlhttp.send();
        }
    }


/* ***********************
PAGE: todos.single.php
*********************** */

    //To-Do DONE checkbox
    function checkbox(bool){
        if(bool.length == 0){
            document.getElementById('done').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('done').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "checkbox.php?id=<?php echo $todo['id']; ?>&checkbox="+bool, true);
            xmlhttp.send();
        } window.location.reload(true);
    }

    function countdownTimer(){
        var countDownDate = new Date().getTime() + 15 * 60 * 1000;
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "Tribunal Done!";
            }
        }, 1000);
    }
