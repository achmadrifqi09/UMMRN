<!DOCTYPE html>
<html>
<head>
    <title>UMMRN</title>
    <style>
       h3{
         padding: 8px 16px; 
         background-color: #A4E636; 
         color: #0E172B; 
         border-radius:8px; 
         width: min-content;
       }
       .title{
         font-size: 24px;
       }
       .signature{
          margin-top: 24px;
          display: flex;
          justify-content: end;
       }
    </style>
</head>
<body>
  <p class="title">{{ $mailData['title'] }}</p>  
  <p>Welcome to UMM Research network, this is your OTP code valid 1 minutes after your email is received</p>
  <h3>{{ $mailData['otp'] }}</h3>

  <div class="signature">
    <div>
      <p>Regards</p>
      <p>UMMRN Development Team</p>
    </div>
  </div>
</body>
</html>