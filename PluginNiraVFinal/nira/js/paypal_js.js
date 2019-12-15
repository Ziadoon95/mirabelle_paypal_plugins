 window.onload = function() {
  for (var i = 1; i <=9; i++) {
  document.getElementById("no"+i).value = '';
  }
  } 
 //check paypal


 //block dy by default is hidden

 var y = document.getElementById("dy");
  y.style.display = "none";
//end block dy by default 

function checkbox()
{
     
}

 function checkpay()
 {  
    fname = document.getElementById('no1').value ; 
    lname = document.getElementById('no2').value ; 
    email = document.getElementById('no3').value ; 
    ad1 = document.getElementById('no4').value ; 
    ville = document.getElementById('no6').value ; 
    codepostal = document.getElementById('no7').value ; 
    montant = document.getElementById('no8').value ; 
    gsm = document.getElementById('no9').value ; 

   if(montant.length==0  || fname.length==0|| lname.length==0 
    || email.length==0|| ad1.length==0
    || codepostal.length==0
    || ville.length==0
   )
   {
     console.log("check false");
     return false ;
   }
   else{
     if(gsm.length==0)
     {
      gsm= '460000000';
     }
     console.log("check true");

     return true;
   }
   }

    fname = document.getElementById('no1').value ; 
    lname = document.getElementById('no2').value ; 
    email = document.getElementById('no3').value ; 
    ad1 = document.getElementById('no4').value ; 
     ville = document.getElementById('no6').value ; 
    codepostal = document.getElementById('no7').value ; 
    montant = document.getElementById('no8').value ; 
    gsm = document.getElementById('no9').value ; 

if(fname != null || lname != null
 ||email != null|| ad1 != null
 || codepostal != null
 ||montant != null|| gsm != null
 ||ville != null
 )
{  

//end of  code

  //paypal code
  paypal.Buttons({

      style: 
      {
      color: 'silver'
      },
     
                //new code
                
                //old 
              
    onInit: function(data, actions) {
        // Disable the buttons
        actions.disable();
        








        // Listen for changes to the checkbox
       
          document.querySelectorAll('.input--style-3').forEach(item => 
            { 
              item.addEventListener('change', function(event) 
              {
                console.log("check");
                if(checkpay() && montant >= 5)
                {
                  
                      console.log(montant);
                      document.getElementById("min").style.color= '#242357'; 
                      document.getElementById("alert").style.visibility= 'hidden'; 

                      console.log('is  filled');

                     console.log(montant);

                     console.log("true the terms");
                     var checkn =  document.getElementById("checkbox")
                     if(!checkn.checked)
                     {
                       document.getElementById("divlabel").style.borderLeft = "1px solid red"; 
                     }else if(checkn.checked && montant >= 5){
                     
                      console.log(montant);
                      actions.enable();
                                     
                      }


                       var checkbox = document.querySelector("input[name=checkbox]");
                       checkbox.addEventListener( 'change', function() {
                        if(this.checked && montant >= 5) {
                          document.getElementById("divlabel").style.border = "none"; 
                          actions.enable();
                        } else{
                          actions.disable();
                        }
                       });
                    
                 }else  
                    {
                        if(montant < 5) 
                        {
                          document.getElementById('no8').value ="";
                          document.getElementById("min").style.color= 'red'; 
                        }
                        console.log('is not fully filled');
                        actions.disable();
                        document.getElementById("alert").style.visibility= 'visible'; 
                        document.getElementById("alert").style.color= 'red'; 
                        document.getElementById("alert").innerHTML= '*Tous les champs ne sont pas remplis'; 
                    }
            }
            )
          });
        
    
        },
           //old code
    createOrder: function(data, actions) {
      return actions.order.create({ 
      intent: 'CAPTURE',
      payer: {
        name: {
          given_name: fname ,
          surname: lname
        },
        address: {
          address_line_1: ad1,
          admin_area_2: ville,
          admin_area_1: 'BE',
          postal_code: codepostal,
          country_code: 'BE'
        },
        email_address: email,//email,//
        phone: {
          phone_type: "MOBILE",
          phone_number: {
            national_number: gsm//phonenumber//
          }
        }
      },
      purchase_units: [
        {
          amount: {
            value:montant, 
            currency_code: 'EUR'
          },
          shipping: {
            address: {
              address_line_1: ad1,
              admin_area_2: ville,
              admin_area_1: 'BE',
              postal_code: codepostal,
              country_code: 'BE'       
            }
          },
        }
      ]
      
      });
    },
    onApprove: function(data, actions) {
      
      // Capture the funds from the transaction
      return actions.order.capture().then(function(details) {
//show success message
var x = document.getElementById("div");
  x.style.display = "none";
  y.style.display = "block";

//hide 
         jQuery.post(
          ajaxurl,
          {
              'action': 'nira_transaction',
              'orderID': data.orderID,
              'fname':fname ,
              'lname':lname ,
              'email':email ,
              'ad1':ad1 ,
              'codepostal':codepostal ,
              'ville':ville ,
              'gsm':gsm ,
              'montant':montant 
          },
          function(response){
                  console.log(response);
              }
      );

      });
    }
    }).render(
      
      '#paypal-button-container');
  
    
}else
{
  console.log('NOOOOOOOOOOOOOOOOO');
}

