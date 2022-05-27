
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
<meta property="product:category" content="Apparel &amp; Accessories &gt; Clothing &gt; Dresses"/>

<meta property="og:title" content="Facebook T-Shirt">
<meta property="og:description" content="Unisex Facebook T-shirt, Small">
<meta property="og:url" content="https://example.org/facebook">
<meta property="og:image" content="https://example.org/facebook.jpg">
<meta property="product:brand" content="Facebook">
<meta property="product:availability" content="in stock">
<meta property="product:condition" content="new">
<meta property="product:price:amount" content="7.99">
<meta property="product:price:currency" content="USD">
<meta property="product:retailer_item_id" content="facebook_tshirt_001">
<meta property="product:item_group_id" content="fb_tshirts">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset("images/icons/favicon.ico")}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("vendor/bootstrap/css/bootstrap.min.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("fonts/font-awesome-4.7.0/css/font-awesome.min.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("vendor/animate/animate.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("vendor/css-hamburgers/hamburgers.min.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("vendor/select2/select2.min.css")}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset("css/util.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/main.css")}}">
    <!--===============================================================================================-->
    <!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '3734673576615174');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=3734673576615174&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100" style="padding-top: 88px;">
            <div class="login100-pic js-tilt" data-tilt>
                <img style="margin-top: 40px;margin-left: 52px;" src="{{asset("img/2.png")}}" alt="IMG">
            </div>
            <form class="login100-form validate-form" method="post" action="{{route("login")}}">
                @csrf

					<span class="login100-form-title">
                        تسجيل دخول
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="اسم الحساب">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
						
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="كلمة السر">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                @if($errors->any())
                   <div style="color:red">يرجي مراجعة الحساب وكلمة المرور</div>
                @endif
                
  

                <div class="container-login100-form-btn">
                    <button  class="login100-form-btn">
                        دخول
                    </button>
                </div>
                

                <div class="text-center p-t-12" style="font-weight: 600;letter-spacing: normal">
                                   في حالة مواجهة مشكلة يرجي الاتصال بنا علي
                </div>
                <span style="letter-spacing: 2px;margin-left: 97px;font-weight: 700;">01122391144</span>

            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>
