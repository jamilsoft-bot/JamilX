

var CList = [
	"Afghanistan",
	"Albania",
	"Algeria",
	"American Samoa",
	"Andorra",
	"Angola",
	"Anguilla",
	"Antarctica",
	"Antigua",
	"Barbuda",
	"Argentina",
	"Armenia",
	"Aruba",
	"Australia",
	"Austria",
	"Azerbaijan",
	"Bahamas",
	"Bahrain",
	"Bangladesh",
	"Barbados",
	"Belarus",
	"Belgium",
	"Belize",
	"Benin",
	"Bermuda",
	"Bhutan",
	"Bolivia ",
	"Bonaire",
	"Bosnia",
    "Herzegovina",
	"Botswana",
	"Bouvet Island",
	"Brazil",
	"British Indian Ocean Territory",
	"Brunei Darussalam",
	"Bulgaria",
	"Burkina Faso",
	"Burundi",
	"Cabo Verde",
	"Cambodia",
	"Cameroon",
	"Canada",
	"Cayman Islands",
	"Central African Republic",
	"Chad",
	"Chile",
	"China",
	"Christmas Island",
	"Cocos (Keeling) Islands",
	"Colombia",
	"Comoros",
	"Congo",
	"Congo",
	"Cook Islands",
	"Costa Rica",
	"Croatia",
	"Cuba",
	"Curaçao",
	"Cyprus",
	"Czechia",
	"Côte d'Ivoire",
	"Denmark",
	"Djibouti",
	"Dominica",
	"Dominican Republic",
	"Ecuador",
	"Egypt",
	"El Salvador",
	"Equatorial Guinea",
	"Eritrea",
	"Estonia",
	"Eswatini",
	"Ethiopia",
	"Falkland Islands [Malvinas]",
	"Faroe Islands",
	"Fiji",
	"Finland",
	"France",
	"French Guiana",
	"French Polynesia",
	"French Southern Territories  ",
	"Gabon",
	"Gambia  ",
	"Georgia",
	"Germany",
	"Ghana",
	"Gibraltar",
	"Greece",
	"Greenland",
	"Grenada",
	"Guadeloupe",
	"Guam",
	"Guatemala",
	"Guernsey",
	"Guinea",
	"Guinea-Bissau",
	"Guyana",
	"Haiti",
	"Heard Island",
    "McDonald Islands",
	"Holy See  ",
	"Honduras",
	"Hong Kong",
	"Hungary",
	"Iceland",
	"India",
	"Indonesia",
	"Iran",
	"Iraq",
	"Ireland",
	"Isle of Man",
	"Israel",
	"Italy",
	"Jamaica",
	"Japan",
	"Jersey",
	"Jordan",
	"Kazakhstan",
	"Kenya",
	"Kiribati",
	"North Korea",
	"South Korea",
	"Kuwait",
	"Kyrgyzstan",
	"Lao People's Democratic Republic  ",
	"Latvia",
	"Lebanon",
	"Lesotho",
	"Liberia",
	"Libya",
	"Liechtenstein",
	"Lithuania",
	"Luxembourg",
	"Macao",
	"Madagascar",
	"Malawi",
	"Malaysia",
	"Maldives",
	"Mali",
	"Malta",
	"Marshall Islands  ",
	"Martinique",
	"Mauritania",
	"Mauritius",
	"Mayotte",
	"Mexico",
	"Micronesia ",
	"Moldova ",
	"Monaco",
	"Mongolia",
	"Montenegro",
	"Montserrat",
	"Morocco",
	"Mozambique",
	"Myanmar",
	"Namibia",
	"Nauru",
	"Nepal",
	"Netherlands  ",
	"New Caledonia",
	"New Zealand",
	"Nicaragua",
	"Niger  ",
	"Nigeria",
	"Niue",
	"Norfolk Island",
	"Northern Mariana Islands  ",
	"Norway",
	"Oman",
	"Pakistan",
	"Palau",
	"Palestine",
	"Panama",
	"Papua New Guinea",
	"Paraguay",
	"Peru",
	"Philippines  ",
	"Pitcairn",
	"Poland",
	"Portugal",
	"Puerto Rico",
	"Qatar",
	"Republic of North Macedonia",
	"Romania",
	"Russian Federation  ",
	"Rwanda",
	"Réunion",
	"Saint Barthélemy",
	"Saint Helena",
    "Ascension",
    "Tristan da Cunha",
	"Saint Kitts and Nevis",
	"Saint Lucia",
	"Saint Martin",
	"Saint Pierre",
    "Miquelon",
	"Saint Vincent",
    "the Grenadines",
	"Samoa",
	"San Marino",
	"Sao Tome",
    "Principe",
	"Saudi Arabia",
	"Senegal",
	"Serbia",
	"Seychelles",
	"Sierra Leone",
	"Singapore",
	"Sint Maarten",
	"Slovakia",
	"Slovenia",
	"Solomon Islands",
	"Somalia",
	"South Africa",
	"South Georgia",
    "South Sandwich Islands",
	"South Sudan",
	"Spain",
	"Sri Lanka",
	"Sudan  ",
	"Suriname",
	"Svalbard",
    "Jan Mayen",
	"Sweden",
	"Switzerland",
	"Syria",
	"Taiwan",
	"Tajikistan",
	"Tanzania",
	"Thailand",
	"Timor-Leste",
	"Togo",
	"Tokelau",
	"Tonga",
	"Trinidad",
    "Tobago",
	"Tunisia",
	"Turkey",
	"Turkmenistan",
	"Turks  ",
    "Caicos Islands",
	"Tuvalu",
	"Uganda",
	"Ukraine",
	"United Arab Emirates  ",
	"United Kingdom   ",
    "Northern Ireland",
	"United States ",
	"Uruguay",
	"Uzbekistan",
	"Vanuatu",
	"Venezuela",
	"Viet Nam",
	"Virgin Islands(British)",
	"Virgin Islands(U.S.)",
	"Wallis",
	"Futuna",
	"Western Sahara",
	"Yemen",
	"Zambia",
	"Zimbabwe",
	"Åland Islands"
];

var Roles = [
	'User',
	'Admin'
]


function loadRoles(cid,attr){
	var text = "<option  disabled>User Roles</option>";
	function Countryloop(value){
       // text += "<option name='" +value+"'>"+value+"</option>" ;
	   if(value == attr){

		text += "<option name='" +value+"' selected>"+value+"</option>" ;


	}else{

	}
	text += "<option name='" +value+"'>"+value+"</option>" ;

	   
    }

	//Roles.sort();
     
     Roles.forEach(Countryloop);
     var role = document.getElementById(cid);
     role.innerHTML = text;

}

function loadCountries(cid,attr){
	var text = "";
	
	function Countryloop(value){
	
	
	if(value == attr){

		text += "<option name='" +value+"' selected>"+value+"</option>" ;


	}else{

	}
	text += "<option name='" +value+"'>"+value+"</option>" ;

		
    }

	CList.sort();
     
     CList.forEach(Countryloop);
     var Countries = document.getElementById(cid);
     Countries.innerHTML = text;

}


function uploadFile(Input_id,btn_id) {


$(document).ready(
        $("#"+ btn_id).click(function(){
            var im = document.getElementById("avatar");
                var myfiles = $("#"+ Input_id)[0].files;
                var f_d = new FormData();
                
                    f_d.append("avatar",myfiles[0])
                
                $.ajax({
                    url : "test.php",
                    type : "post",
                    data :  f_d,
                    contentType: false,
                    processData: false,
                    success : function(data, success){
                        alert("data: " + data)
                    }

                })
            
        })
    )
	
}


function uploadFileR(Input_id,btn_id,out) {


	$(document).ready(
			$("#"+ btn_id).click(function(){
				var im = document.getElementById("avatar");
					var myfiles = $("#"+ Input_id)[0].files;
					var f_d = new FormData();
					
						f_d.append("avatar",myfiles[0])
					
					$.ajax({
						url : "test.php",
						type : "post",
						data :  f_d,
						contentType: false,
						processData: false,
						success : function(data, success){
							out.innerHTML = data
						}
	
					})
				
			})
		)
		
	}
	