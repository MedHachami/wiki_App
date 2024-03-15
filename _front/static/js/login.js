const apiurl = "http://localhost/med_hachami_wiki/";

function login(ev){
    ev.preventDefault();
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    let input_error =  document.getElementById("input_error");
    
    
    input_error.textContent = '';
    

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const validEmail = emailRegex.test(email);

    if(!email || !validEmail){
        input_error.textContent = "*Credentials not valid ! try again";
    }
    if(password.length <6){
        input_error.textContent = "*Credentials not valid ! try again";    }

    if(input_error.textContent ===''){
        const data = {
            "email": email,
            "password": password
            
        }
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                
            },
            body: JSON.stringify(data),
        };

        fetch(`${apiurl}` + 'Users/login',requestOptions)
            .then(response => {
                
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                
                return response.json();
            })
            .then(data => {
                    if(data.token){
                        localStorage.setItem('token', data.token);
                        const decodedPayload = decodeJWT(data.token);
                        console.log(decodedPayload);
                        localStorage.setItem('id' ,decodedPayload.data.id);
                        localStorage.setItem('fullName' ,decodedPayload.data.full_name);
                        localStorage.setItem('email' ,decodedPayload.data.email);
                        localStorage.setItem('image' ,decodedPayload.data.imgUrl);

                        window.location.href = '/';
                    }else{
                        input_error.textContent = "*Credentials not valid ! try again"; 
                    }
            })
            .catch(error => {
              
                console.log('Error:'+ error.message);
            });
    }

    console.log(email + " " + password);
}   

function decodeJWT(token) {
    
    const [header, payload, signature] = token.split('.');
    const decodedPayload = JSON.parse(atob(payload));
  
    
    return decodedPayload;
}
  
 