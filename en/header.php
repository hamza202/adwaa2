<? session_start();?>
<script>
    $(document).ready(function(){
        $(".form-item").submit(function(e){
            var form_data = $(this).serialize();
            var button_content = $(this).find('button[type=submit]');
            button_content.html('Adding...'); //Loading button text

            $.ajax({ //make ajax request to cart_process.php
                url: "cart_process.php",
                type: "POST",
                dataType:"json", //expect json value from server
                data: form_data
            }).done(function(data){ //on Ajax success
                $("#cart-info").html(data.items); //total items in cart-info element
                button_content.html('Add to Cart'); //reset button text to original text
                if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible
                    $(".cart-box").trigger( "click" ); //trigger click to update the cart box.
                }
            })
            e.preventDefault();
        });

        //Show Items in Cart
        $( ".cart-box").click(function(e) { //when user clicks on cart box
            e.preventDefault();
            $(".shopping-cart-box").fadeIn(); //display cart box
            $("#shopping-cart-results").html('<img src="images/ajax-loader.gif">'); //show loading image
            $("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results
        });

        //Close Cart
        $( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
            e.preventDefault();
            $(".shopping-cart-box").fadeOut(); //close cart-box
        });

        //Remove items from cart
        $("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
            e.preventDefault();
            var pcode = $(this).attr("data-code"); //get product code
            $(this).parent().fadeOut(); //remove item element from box
            $.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
                $("#cart-info").html(data.items); //update Item count in cart-info
                $(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
            });
        });

    });
</script>

<section class="fix-nav">
    <div class="container-fluid logo-bar-bg">
        <div class="logo-top-row">
            <div class="col-lg-3 text-center"><a href="index.html"><img src="assests/img/logo.png"
                                                                        alt=""/></a></div>
            <div class="col-lg-9">
                <div class="clearfix"></div>
                <div class="col-lg-9">
                    <div class="row text-center">
                        <div class="drop-select">
                            <div class="search-bar">
                                <div class="search-bar-item">
                                    <input type="text" placeholder="What are you looking for...">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 wishlist">
                    <div class="row">
                    <a href="#" class="lang" style=" float: left;
    position: relative;
    top: 27px;
    color: #fff !important;">AR</a>
                        <div class="sign-in">
                            <a href="#" data-toggle="modal" data-target="#myModal2">
                                <p>Sign in</p>
                                <i class="fa fa-user-circle" aria-hidden="true"></i></a>
                            <div class="sign-in-hover">
                                <a>Your Account</a>
                                <a>Logout</a>
                                <a href="#" data-toggle="modal" data-target="#myModal2" class="login">Login</a></div>
                        </div>
                        <div class="shop-cart">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <a href="#" class="cart-box" id="cart-info" title="View Cart">
                                <?php
                                        if(isset($_SESSION["products_a"])){
                                            echo count($_SESSION["products_a"]);
                                        }else{
                                            echo 0;
                                        }
                                        ?>
                            </a>


                            <div class="shopping-cart-box">
                                <a href="#" class="close-shopping-cart-box" >Close</a>
                                <h3>Your Shopping Cart</h3>
                                <div id="shopping-cart-results">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
        <div id="main-nav" class="stellarnav">
            <ul>
                <li><a href="">Home</a>
                </li>
                <li><a href="products.php">Products</a>
                    <ul>
                        <li><a href="#">How deep?</a>
                            <ul>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Here's a very long item. It can be as long as you want</a></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </li>
                <li><a href="">Manufacturing</a></li>
                <li><a href="">Industries</a></li>
                <li><a href="contact.php">Contact us</a></li>
                <li><a href="">Catalog</a></li>

            </ul>
        </div><!-- .stellar-nav -->
</section>


<!-- Modal -->
<div class="modal fade login-modal" id="myModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <div class="col-sm-5">
                    <div class="modal-img"><img src="assests/img/modal-img.jpg" class="img-responsive" alt=""/></div>
                </div>
                <div class="col-sm-7 modal-text text-center">
                    <div class="form-sec">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"><a href="#home2" aria-controls="home2" role="tab" data-toggle="tab">Login</a>
                            </li>
                            <li role="presentation" class="active"><a href="#profile2" aria-controls="profile2"
                                                                      role="tab" data-toggle="tab">Sign up</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="profile2">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-row">
                                                <i class="fa fa-user"></i>
                                             <input type="text" placeholder="Name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-row">
                                                <i class="fa fa-building"></i>
                                                <input type="text" placeholder="Company Name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-row"><img src="assests/img/icon/phone.png" alt=""/>
                                                <input type="text" placeholder="Mobile Number" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-row"><img src="assests/img/icon/email.png" alt=""/>
                                                <input type="email" placeholder="Email ID" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-row"><img src="assests/img/icon/key.png" alt=""/>
                                                <input id="password"  type="password" placeholder="Enter your password" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-row"><img src="assests/img/icon/key.png" alt=""/>
                                                <input id="confirm_password" type="password" placeholder="Confirm Password" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control sin-select">
                                                    <option value="">Country...</option>
                                                    <option value="Afganistan">Afghanistan</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="American Samoa">American Samoa</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Anguilla">Anguilla</option>
                                                    <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Aruba">Aruba</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="Bonaire">Bonaire</option>
                                                    <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                                    <option value="Brunei">Brunei</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Canary Islands">Canary Islands</option>
                                                    <option value="Cape Verde">Cape Verde</option>
                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                    <option value="Central African Republic">Central African Republic</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Channel Islands">Channel Islands</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Christmas Island">Christmas Island</option>
                                                    <option value="Cocos Island">Cocos Island</option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo">Congo</option>
                                                    <option value="Cook Islands">Cook Islands</option>
                                                    <option value="Costa Rica">Costa Rica</option>
                                                    <option value="Cote DIvoire">Cote D'Ivoire</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Curaco">Curacao</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="Czech Republic">Czech Republic</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                    <option value="East Timor">East Timor</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="El Salvador">El Salvador</option>
                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Falkland Islands">Falkland Islands</option>
                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="French Guiana">French Guiana</option>
                                                    <option value="French Polynesia">French Polynesia</option>
                                                    <option value="French Southern Ter">French Southern Ter</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia">Gambia</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Gibraltar">Gibraltar</option>
                                                    <option value="Great Britain">Great Britain</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Greenland">Greenland</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                    <option value="Guam">Guam</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Hawaii">Hawaii</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hong Kong">Hong Kong</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran">Iran</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Isle of Man">Isle of Man</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="Korea North">Korea North</option>
                                                    <option value="Korea Sout">Korea South</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Laos">Laos</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libya">Libya</option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macau">Macau</option>
                                                    <option value="Macedonia">Macedonia</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                    <option value="Martinique">Martinique</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mayotte">Mayotte</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Midway Islands">Midway Islands</option>
                                                    <option value="Moldova">Moldova</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montserrat">Montserrat</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Myanmar">Myanmar</option>
                                                    <option value="Nambia">Nambia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherland Antilles">Netherland Antilles</option>
                                                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                                    <option value="Nevis">Nevis</option>
                                                    <option value="New Caledonia">New Caledonia</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="Niue">Niue</option>
                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau Island">Palau Island</option>
                                                    <option value="Palestine">Palestine</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Phillipines">Philippines</option>
                                                    <option value="Pitcairn Island">Pitcairn Island</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                                                    <option value="Republic of Serbia">Republic of Serbia</option>
                                                    <option value="Reunion">Reunion</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="Russia">Russia</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="St Barthelemy">St Barthelemy</option>
                                                    <option value="St Eustatius">St Eustatius</option>
                                                    <option value="St Helena">St Helena</option>
                                                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                                    <option value="St Lucia">St Lucia</option>
                                                    <option value="St Maarten">St Maarten</option>
                                                    <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                                                    <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                                                    <option value="Saipan">Saipan</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="Samoa American">Samoa American</option>
                                                    <option value="San Marino">San Marino</option>
                                                    <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Swaziland">Swaziland</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syria">Syria</option>
                                                    <option value="Tahiti">Tahiti</option>
                                                    <option value="Taiwan">Taiwan</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania">Tanzania</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tokelau">Tokelau</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Erimates">United Arab Emirates</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="United States of America">United States of America</option>
                                                    <option value="Uraguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Vatican City State">Vatican City State</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Vietnam">Vietnam</option>
                                                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                                    <option value="Wake Island">Wake Island</option>
                                                    <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zaire">Zaire</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>

                                <div class="clearfix"></div>
                                <button type="submit" class="button sin-btn"><span><img src="assests/img/icon/lock.png" alt=""/> Create
                                        your account</span></button>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="home2">
                                <form>
                                <div class="input-row"><img src="assests/img/icon/email.png" alt=""/>
                                    <input type="email" placeholder="Email ID "/>
                                </div>
                                <div class="input-row"><img src="assests/img/icon/key.png" alt=""/>
                                    <input type="password" placeholder="Enter your password"/>
                                </div>
                                <div class="forgot-row"><a data-toggle="modal" data-target="#myModal3"
                                                           class="pull-right for-1" href="#">Forgot password?</a></div>
                                <div class="clearfix"></div>
                                <div class="clearfix"></div>
                                <button type="submit" class="button sin-btn"><span><img src="assests/img/icon/lock.png" alt=""/> Secure
                                        Login</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade login-modal" id="myModal3" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <div class="col-sm-5">
                    <div class="modal-img"><img src="assests/img/modal-img.jpg" class="img-responsive" alt=""/></div>
                </div>
                <div class="col-sm-7 modal-text">
                    <div class="form-sec">
                        <h2>Forgot Password?</h2>
                        <p>To reset your password, please Enter your email below.</p>
                        <div class="input-row"><img src="assests/img/icon/email.png" alt=""/>
                            <input type="email" placeholder="Email ID (optional)"/>
                        </div>
                        <div class="button"><a href="#">Send</a></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script>
    var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>