const mic_search_form = document.getElementById("product_search");
const search_bar = document.getElementById("search_bar");

const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

if(SpeechRecognition){
    const mic_btn = document.getElementById("mic_btn");
    const mic_icon = document.getElementById("mic_icon");
    

    
    const recognition = new SpeechRecognition();
    
    mic_btn.addEventListener("click",micBtnClick);
    function micBtnClick(){
            if(mic_icon.classList.contains("fa-microphone")){ //START
                recognition.start();
            }
            else{ //STOP
                recognition.stop();
            }
        
        recognition.addEventListener("start",startSpeechRecognition);
        
        
        function startSpeechRecognition(){
            mic_icon.classList.add("fa-microphone-slash");
            mic_icon.classList.remove("fa-microphone");
            search_bar.focus();
            console.log("Speech active");
        }
        
        recognition.addEventListener("end",stopSpeechRecognition);
        
        function stopSpeechRecognition(){
            mic_icon.classList.remove('fa-microphone-slash');
            mic_icon.classList.add("fa-microphone");
            search_bar.focus();
            console.log("Speech ended");
        }
        
        recognition.addEventListener("result",resultofSpeechRecognition);

        function resultofSpeechRecognition(event){
            const transcript = event.results[0][0].transcript;
            search_bar.value=transcript;
            setTimeout(()=>{
                mic_search_form.submit();
;            },750);
        }
    }
}

else{
    console.log("no");
}