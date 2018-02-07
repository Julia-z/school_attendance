@extends('layouts.dashboard')
<style>

  .input-group2{
    padding: 20px;
    border: 1px #B39DDB solid;
    border-radius: 5px;
    margin-bottom: 20px;
  }
  .page-title{
    background-color: #EEF;
    color: #0D47A1;
    min-height: 20px;
    padding: 20px;
    margin-bottom: 20px;
    border: 1px #DDF solid;
    border-radius: 5px;
  }
  .row{
    color: #311B92;
  }
  .container{
    padding-bottom: 20px;
  }

  .indigo{
    background-color: #C5CAE9;
    color: #1A237E;
    font-weight: 900;
  }
  .lang_error{
    color: #EF5350;
    padding-left: 10px;
    font-size: 10pt;
  }
</style>
@section('content')
<div class="container">
    <div class="row">
              <div dir="auto" class="container-fluid" >
                  <h1  class="col-md-12  page-title">@lang('messages.register_title')</h1>
                  <div class="col-md-12 wel">
                      <form  id="register_student_form" action="/post_student" method="post" onsubmit="return validate_form();">
                          <div class="input-group2">
                            <!-- name English -->
                            <div class="row">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-sm-4 form-group">
                                  <label>@lang('messages.first_name_en')</label><span class="lang_error" id="error_en1"></span>
                                  <input type="text" required="true" name="first_name_en" placeholder=@lang('messages.first_name_en_holder') class="form-control must-english">
                                </div>
                                <div class="col-sm-4 form-group">
                                  <label>@lang('messages.middle_name_en')</label><span class="lang_error" id="error_en2"></span>
                                  <input type="text" required="true" name="middle_name_en" placeholder=@lang('messages.middle_name_en_holder') class="form-control must-english">
                                </div>
                                <div class="col-sm-4 form-group">
                                  <label>@lang('messages.last_name_en')</label><span class="lang_error" id="error_en3"></span>
                                  <input type="text" required="true" name="last_name_en" placeholder=@lang('messages.last_name_en_holder') class="form-control must-english">
                                </div>
                              </div>
                            <!-- name Arabic -->
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                  <label>@lang('messages.first_name_ar')</label><span class="lang_error" id="error_ar1"></span>
                                  <input type="text" required="true" name="first_name_ar" placeholder=@lang('messages.first_name_ar_holder') class="form-control must-arabic">
                                </div>
                                <div class="col-sm-4 form-group">
                                  <label>@lang('messages.middle_name_ar')</label><span class="lang_error" id="error_ar2"></span>
                                  <input type="text" required="true" name="middle_name_ar" placeholder=@lang('messages.middle_name_ar_holder') class="form-control must-arabic">
                                </div>
                                <div class="col-sm-4 form-group">
                                  <label>@lang('messages.last_name_ar')</label><span class="lang_error" id="error_ar3"></span>
                                  <input type="text" required="true" name="last_name_ar" placeholder=@lang('messages.last_name_ar_holder') class="form-control must-arabic">
                                </div>
                              </div>
                            <!-- ids -->
                            <div class="row">
                              <div class="col-sm-6 form-group">
                                <label>@lang('messages.unrwa')</label>
                                <input type="text" name="unrwa_id" placeholder=@lang('messages.unrwa_holder') class="form-control">
                              </div>
                              <div class="col-sm-6 form-group">
                                <label>@lang('messages.passport')</label>
                                <input type="text" name="passport_number" placeholder=@lang('messages.passport_holder') class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="input-group2">
                            <div class="row">
                              <div class="col-sm-4 form-group">
                                <label>@lang('messages.nationality')</label>
                                <input name="nationality" required="true"  type="text" placeholder=@lang('messages.nationality_holder') class="form-control">
                                <!--<select name="nationality" class="form-control">
                                  <option value="afghan">Afghan</option>
                                  <option value="albanian">Albanian</option>
                                  <option value="algerian">Algerian</option>
                                  <option value="american">American</option>
                                  <option value="andorran">Andorran</option>
                                  <option value="angolan">Angolan</option>
                                  <option value="antiguans">Antiguans</option>
                                  <option value="argentinean">Argentinean</option>
                                  <option value="armenian">Armenian</option>
                                  <option value="australian">Australian</option>
                                  <option value="austrian">Austrian</option>
                                  <option value="azerbaijani">Azerbaijani</option>
                                  <option value="bahamian">Bahamian</option>
                                  <option value="bahraini">Bahraini</option>
                                  <option value="bangladeshi">Bangladeshi</option>
                                  <option value="barbadian">Barbadian</option>
                                  <option value="barbudans">Barbudans</option>
                                  <option value="batswana">Batswana</option>
                                  <option value="belarusian">Belarusian</option>
                                  <option value="belgian">Belgian</option>
                                  <option value="belizean">Belizean</option>
                                  <option value="beninese">Beninese</option>
                                  <option value="bhutanese">Bhutanese</option>
                                  <option value="bolivian">Bolivian</option>
                                  <option value="bosnian">Bosnian</option>
                                  <option value="brazilian">Brazilian</option>
                                  <option value="british">British</option>
                                  <option value="bruneian">Bruneian</option>
                                  <option value="bulgarian">Bulgarian</option>
                                  <option value="burkinabe">Burkinabe</option>
                                  <option value="burmese">Burmese</option>
                                  <option value="burundian">Burundian</option>
                                  <option value="cambodian">Cambodian</option>
                                  <option value="cameroonian">Cameroonian</option>
                                  <option value="canadian">Canadian</option>
                                  <option value="cape verdean">Cape Verdean</option>
                                  <option value="central african">Central African</option>
                                  <option value="chadian">Chadian</option>
                                  <option value="chilean">Chilean</option>
                                  <option value="chinese">Chinese</option>
                                  <option value="colombian">Colombian</option>
                                  <option value="comoran">Comoran</option>
                                  <option value="congolese">Congolese</option>
                                  <option value="costa rican">Costa Rican</option>
                                  <option value="croatian">Croatian</option>
                                  <option value="cuban">Cuban</option>
                                  <option value="cypriot">Cypriot</option>
                                  <option value="czech">Czech</option>
                                  <option value="danish">Danish</option>
                                  <option value="djibouti">Djibouti</option>
                                  <option value="dominican">Dominican</option>
                                  <option value="dutch">Dutch</option>
                                  <option value="east timorese">East Timorese</option>
                                  <option value="ecuadorean">Ecuadorean</option>
                                  <option value="egyptian">Egyptian</option>
                                  <option value="emirian">Emirian</option>
                                  <option value="equatorial guinean">Equatorial Guinean</option>
                                  <option value="eritrean">Eritrean</option>
                                  <option value="estonian">Estonian</option>
                                  <option value="ethiopian">Ethiopian</option>
                                  <option value="fijian">Fijian</option>
                                  <option value="filipino">Filipino</option>
                                  <option value="finnish">Finnish</option>
                                  <option value="french">French</option>
                                  <option value="gabonese">Gabonese</option>
                                  <option value="gambian">Gambian</option>
                                  <option value="georgian">Georgian</option>
                                  <option value="german">German</option>
                                  <option value="ghanaian">Ghanaian</option>
                                  <option value="greek">Greek</option>
                                  <option value="grenadian">Grenadian</option>
                                  <option value="guatemalan">Guatemalan</option>
                                  <option value="guinea-bissauan">Guinea-Bissauan</option>
                                  <option value="guinean">Guinean</option>
                                  <option value="guyanese">Guyanese</option>
                                  <option value="haitian">Haitian</option>
                                  <option value="herzegovinian">Herzegovinian</option>
                                  <option value="honduran">Honduran</option>
                                  <option value="hungarian">Hungarian</option>
                                  <option value="icelander">Icelander</option>
                                  <option value="indian">Indian</option>
                                  <option value="indonesian">Indonesian</option>
                                  <option value="iranian">Iranian</option>
                                  <option value="iraqi">Iraqi</option>
                                  <option value="irish">Irish</option>
                                  <option value="israeli">Israeli</option>
                                  <option value="italian">Italian</option>
                                  <option value="ivorian">Ivorian</option>
                                  <option value="jamaican">Jamaican</option>
                                  <option value="japanese">Japanese</option>
                                  <option value="jordanian">Jordanian</option>
                                  <option value="kazakhstani">Kazakhstani</option>
                                  <option value="kenyan">Kenyan</option>
                                  <option value="kittian and nevisian">Kittian and Nevisian</option>
                                  <option value="kuwaiti">Kuwaiti</option>
                                  <option value="kyrgyz">Kyrgyz</option>
                                  <option value="laotian">Laotian</option>
                                  <option value="latvian">Latvian</option>
                                  <option value="lebanese">Lebanese</option>
                                  <option value="liberian">Liberian</option>
                                  <option value="libyan">Libyan</option>
                                  <option value="liechtensteiner">Liechtensteiner</option>
                                  <option value="lithuanian">Lithuanian</option>
                                  <option value="luxembourger">Luxembourger</option>
                                  <option value="macedonian">Macedonian</option>
                                  <option value="malagasy">Malagasy</option>
                                  <option value="malawian">Malawian</option>
                                  <option value="malaysian">Malaysian</option>
                                  <option value="maldivan">Maldivan</option>
                                  <option value="malian">Malian</option>
                                  <option value="maltese">Maltese</option>
                                  <option value="marshallese">Marshallese</option>
                                  <option value="mauritanian">Mauritanian</option>
                                  <option value="mauritian">Mauritian</option>
                                  <option value="mexican">Mexican</option>
                                  <option value="micronesian">Micronesian</option>
                                  <option value="moldovan">Moldovan</option>
                                  <option value="monacan">Monacan</option>
                                  <option value="mongolian">Mongolian</option>
                                  <option value="moroccan">Moroccan</option>
                                  <option value="mosotho">Mosotho</option>
                                  <option value="motswana">Motswana</option>
                                  <option value="mozambican">Mozambican</option>
                                  <option value="namibian">Namibian</option>
                                  <option value="nauruan">Nauruan</option>
                                  <option value="nepalese">Nepalese</option>
                                  <option value="new zealander">New Zealander</option>
                                  <option value="ni-vanuatu">Ni-Vanuatu</option>
                                  <option value="nicaraguan">Nicaraguan</option>
                                  <option value="nigerien">Nigerien</option>
                                  <option value="north korean">North Korean</option>
                                  <option value="northern irish">Northern Irish</option>
                                  <option value="norwegian">Norwegian</option>
                                  <option value="omani">Omani</option>
                                  <option value="pakistani">Pakistani</option>
                                  <option value="palauan">Palauan</option>
                                  <option value="palestinian" selected="selected">Palestinian</option>
                                  <option value="panamanian">Panamanian</option>
                                  <option value="papua new guinean">Papua New Guinean</option>
                                  <option value="paraguayan">Paraguayan</option>
                                  <option value="peruvian">Peruvian</option>
                                  <option value="polish">Polish</option>
                                  <option value="portuguese">Portuguese</option>
                                  <option value="qatari">Qatari</option>
                                  <option value="romanian">Romanian</option>
                                  <option value="russian">Russian</option>
                                  <option value="rwandan">Rwandan</option>
                                  <option value="saint lucian">Saint Lucian</option>
                                  <option value="salvadoran">Salvadoran</option>
                                  <option value="samoan">Samoan</option>
                                  <option value="san marinese">San Marinese</option>
                                  <option value="sao tomean">Sao Tomean</option>
                                  <option value="saudi">Saudi</option>
                                  <option value="scottish">Scottish</option>
                                  <option value="senegalese">Senegalese</option>
                                  <option value="serbian">Serbian</option>
                                  <option value="seychellois">Seychellois</option>
                                  <option value="sierra leonean">Sierra Leonean</option>
                                  <option value="singaporean">Singaporean</option>
                                  <option value="slovakian">Slovakian</option>
                                  <option value="slovenian">Slovenian</option>
                                  <option value="solomon islander">Solomon Islander</option>
                                  <option value="somali">Somali</option>
                                  <option value="south african">South African</option>
                                  <option value="south korean">South Korean</option>
                                  <option value="spanish">Spanish</option>
                                  <option value="sri lankan">Sri Lankan</option>
                                  <option value="sudanese">Sudanese</option>
                                  <option value="surinamer">Surinamer</option>
                                  <option value="swazi">Swazi</option>
                                  <option value="swedish">Swedish</option>
                                  <option value="swiss">Swiss</option>
                                  <option value="syrian">Syrian</option>
                                  <option value="taiwanese">Taiwanese</option>
                                  <option value="tajik">Tajik</option>
                                  <option value="tanzanian">Tanzanian</option>
                                  <option value="thai">Thai</option>
                                  <option value="togolese">Togolese</option>
                                  <option value="tongan">Tongan</option>
                                  <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                  <option value="tunisian">Tunisian</option>
                                  <option value="turkish">Turkish</option>
                                  <option value="tuvaluan">Tuvaluan</option>
                                  <option value="ugandan">Ugandan</option>
                                  <option value="ukrainian">Ukrainian</option>
                                  <option value="uruguayan">Uruguayan</option>
                                  <option value="uzbekistani">Uzbekistani</option>
                                  <option value="venezuelan">Venezuelan</option>
                                  <option value="vietnamese">Vietnamese</option>
                                  <option value="welsh">Welsh</option>
                                  <option value="yemenite">Yemenite</option>
                                  <option value="zambian">Zambian</option>
                                  <option value="zimbabwean">Zimbabwean</option>
                                </select>
-->
                              </div>
                              <div class="col-sm-4 form-group">
                                <label>@lang('messages.gender')</label>
                                <select name="gender" class="form-control">
                                  <option value="F">@lang('messages.female')</option>
                                  <option value="M">@lang('messages.male')</option>
                                </select>
                              </div>
                              <div class="col-sm-4 form-group">
                                <label>@lang('messages.tongue')</label>
                                <select name="tongue" class="form-control">
                                  <option value="ar" selected="selected">@lang('messages.ar')</option>
                                  <option value="en" >@lang('messages.en')</option>
                                  <option value="fr" >@lang('messages.fr')</option>
                                </select>
                      <!---         <select name="tongue" class="form-control">
                                  <option value="AF">Afrikanns</option>
                                  <option value="SQ">Albanian</option>
                                  <option value="AR" selected="selected">Arabic</option>
                                  <option value="HY">Armenian</option>
                                  <option value="EU">Basque</option>
                                  <option value="BN">Bengali</option>
                                  <option value="BG">Bulgarian</option>
                                  <option value="CA">Catalan</option>
                                  <option value="KM">Cambodian</option>
                                  <option value="ZH">Chinese (Mandarin)</option>
                                  <option value="HR">Croation</option>
                                  <option value="CS">Czech</option>
                                  <option value="DA">Danish</option>
                                  <option value="NL">Dutch</option>
                                  <option value="EN">English</option>
                                  <option value="ET">Estonian</option>
                                  <option value="FJ">Fiji</option>
                                  <option value="FI">Finnish</option>
                                  <option value="FR">French</option>
                                  <option value="KA">Georgian</option>
                                  <option value="DE">German</option>
                                  <option value="EL">Greek</option>
                                  <option value="GU">Gujarati</option>
                                  <option value="HE">Hebrew</option>
                                  <option value="HI">Hindi</option>
                                  <option value="HU">Hungarian</option>
                                  <option value="IS">Icelandic</option>
                                  <option value="ID">Indonesian</option>
                                  <option value="GA">Irish</option>
                                  <option value="IT">Italian</option>
                                  <option value="JA">Japanese</option>
                                  <option value="JW">Javanese</option>
                                  <option value="KO">Korean</option>
                                  <option value="LA">Latin</option>
                                  <option value="LV">Latvian</option>
                                  <option value="LT">Lithuanian</option>
                                  <option value="MK">Macedonian</option>
                                  <option value="MS">Malay</option>
                                  <option value="ML">Malayalam</option>
                                  <option value="MT">Maltese</option>
                                  <option value="MI">Maori</option>
                                  <option value="MR">Marathi</option>
                                  <option value="MN">Mongolian</option>
                                  <option value="NE">Nepali</option>
                                  <option value="NO">Norwegian</option>
                                  <option value="FA">Persian</option>
                                  <option value="PL">Polish</option>
                                  <option value="PT">Portuguese</option>
                                  <option value="PA">Punjabi</option>
                                  <option value="QU">Quechua</option>
                                  <option value="RO">Romanian</option>
                                  <option value="RU">Russian</option>
                                  <option value="SM">Samoan</option>
                                  <option value="SR">Serbian</option>
                                  <option value="SK">Slovak</option>
                                  <option value="SL">Slovenian</option>
                                  <option value="ES">Spanish</option>
                                  <option value="SW">Swahili</option>
                                  <option value="SV">Swedish </option>
                                  <option value="TA">Tamil</option>
                                  <option value="TT">Tatar</option>
                                  <option value="TE">Telugu</option>
                                  <option value="TH">Thai</option>
                                  <option value="BO">Tibetan</option>
                                  <option value="TO">Tonga</option>
                                  <option value="TR">Turkish</option>
                                  <option value="UK">Ukranian</option>
                                  <option value="UR">Urdu</option>
                                  <option value="UZ">Uzbek</option>
                                  <option value="VI">Vietnamese</option>
                                  <option value="CY">Welsh</option>
                                  <option value="XH">Xhosa</option>
                                </select>
                            -->  </div>
                            </div>

                            <div class="row">
                            <div class="col-sm-4 form-group">
                              <label>@lang('messages.date_of_birth')</label>
                              <input type="date" name="date_of_birth" value="2011-08-19" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                              <label>@lang('messages.grade')</label>
                              <select name="grade" class="form-control">
                                <option>KG1</option>
                                <option>KG2</option>
                                <option selected="selected">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                              </select>
                            </div>
                            <div class="col-sm-4 form-group">
                              <label>@lang('messages.section')</label>
                              <input type="number"  required="true"  name="section" class="form-control" placeholder=@lang('messages.section')>
                            </div>
                            </div>
                          </div>
                          <div class="input-group2">
                            <div class="row">
                            <div class="col-sm-6 form-group">
                              <label>@lang('messages.address_en')</label>
                              <textarea name="address_en" placeholder=@lang('messages.address_en_holder') rows="2" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                              <label>@lang('messages.address_ar')</label>
                              <textarea name="address_ar" placeholder=@lang('messages.address_ar_holder') rows="2" class="form-control"></textarea>
                            </div>
                          </div>
                            <div class="row">
                            <div class="col-sm-12 form-group">
                              <label>@lang('messages.medical_conditions')</label>
                              <textarea name="medical_conditions" placeholder=@lang('messages.medical_conditions_holder') rows="3" class="form-control"></textarea>
                            </div>
                          </div>
                        </div>
                        <span hidden class="hidden_message_en">@lang('errors.use_english')</span>
                        <span hidden class="hidden_message_ar">@lang('errors.use_arabic')</span></br>
                        <button type="submit" class="col-md-2 col-md-offset-5 btn indigo">@lang('messages.submit')</button>

                      </form>

            </div>
    </div>
</div>
<script src="http://malsup.github.com/jquery.form.js"></script>

<script type="text/javascript">
  // prepare the form when the DOM is ready
  $(document).ready(function() {
      $('#register_student_form').ajaxForm( { beforeSubmit: validate } );
  });
  function validate_form(){
    var all_errors = $(".lang_error");
    all_errors.html("");
    valide = true;
    var arabics = $(".must-arabic");
    for(var i = 0; i < arabics.length; i++){
      s = arabics[i].value;
      if(s.match(".*[a-z].*")) {
        error_msg = $(".hidden_message_ar").html();

        $("#error_ar"+(i+1)).html(error_msg);
        valid = false;
      }
    }
    var en = $(".must-english");
    for(var i = 0; i < en.length; i++){
      s = en[i].value;
      if(!s.match(".*[a-z].*")) {
        error_msg = $(".hidden_message_en").html();
        $("#error_en"+(i+1)).html(error_msg);
        valid = false;
      }
    }
    return valid;
  }
</script>

@endsection
