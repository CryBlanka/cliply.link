<?php

//$usr_agent=$_SERVER["HTTP_USER_AGENT"];
//if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$usr_agent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($usr_agent,0,4))){
//    header("Location: http://m.cliply.link/");
//}

    //Get user IP address
        //$ip=$_SERVER['REMOTE_ADDR'];
        //Using the API to get information about this IP
        // $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=$ip"));
    //Using the geoplugin to get the continent for this IP
           // $continent=$details->geoplugin_continentCode;
    //And for the country
          //  $country=$details->geoplugin_countryCode;
    //If continent is Europe
         //   if($country==="RU"){
         //   header("Location: http://cliply.link/prohibited.php");
           // } elseif ($country==="BY"){
           // header("Location: http://cliply.link/prohibited.php");
         //   }

include_once 'Config/CUFunction.php';
$CUF_OBJ = New CUFunction();

$Domain = $_SERVER['HTTP_HOST'];

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $Request_Query = $_SERVER['REQUEST_URI'];
    $Request_Query = $CUF_OBJ->validate(trim($Request_Query));
    $Request_Query = str_replace("/",'',$Request_Query);

    if((strlen($Request_Query) == 7) && is_string($Request_Query)){

        $condition['s_new_link'] = $Domain.'/'.$Request_Query;
        $Find_Fetch = $CUF_OBJ->select_assoc('shorturl', $condition);

        if($Find_Fetch){

            $Get_Link = $Find_Fetch['s_original_link'];

            header("Location: $Get_Link");
            exit();

        }
        else{
            header("Location: Error.php");
            exit();
        }

    }
    else{

        if($Request_Query == 'index.php' || strlen($Request_Query) >= 1){
            header("Location: http://cliply.link/"); 
            exit();
        }

    }

}
else{
    header("Location: Error.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cliply a link management platform that lets you harness the power of your links by shortening and sharing your content.">
    <meta name="theme-color" content="#ee00ff">
    <title>Cliply</title>
    <link rel = "icon" href = "https://clippsly.org/wp-content/uploads/2022/06/RefreshedClippslyLogoClipplyNoBG.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="Assets/CSS/Style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="container">
            <div class="center-screen">
                <div class="col-lg-8">
                    <div class="main-box">
                        <div class="URL-Head">
                            <p><img src="https://clippsly.org/wp-content/uploads/2022/06/ClipplyBanner.png" alt="" class="Cliply-Logo" width="290" height="119" /></p>
                        </div>
                        <form id="S_Form" method="POST" autocomplete="off">
                            <div class="form-group row">
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="A_URL" id="A_URL" max="800" placeholder="Enter The Link To Here">
                            </div>
                            <div class="col-lg-3">
                                <input type="submit" id="S_BTN" class="btn btn-outline-danger w-100" value="Short It!">
                            </div>
                            </div>
                        </form>
                        <div class="status">&#128071; URL &#128071;</div>
                        <div class="URL-Footer">
                            <span id="Status"></span>
                            <div class="spinner-border" role="status" id="Loader">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-outline-danger mt-4" data-toggle="modal" data-target=".bd-example-modal-xl">VIEW ALL URL</button>
                        <p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">Copyright &copy; 2022 <a title="Clipplsy" href="https://clippsly.org">Clippsly Ltd</a></p>
<p style="text-align: center;"><a title="Terms of Conditions" href="https://clippsly.org/knowledge-base/cliply/community-cliply/terms-and-conditions/" target="_blank">Terms of Conditions</a> | <a title="Privacy Policy" href="https://clippsly.org/knowledge-base/cliply/community-cliply/privacy-policy-clipply/" target="_blank">Privacy Policy</a> | <a title="Cookies" href="https://clippsly.org/knowledge-base/cliply/community-cliply/cookies-cliply/" target="_blank">Cookies</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ALL LINKS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="View_Data">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function (){
        
        $('.View_Data').load('view_links.php');

        $('#Loader').hide();
           
        $(document).on('submit', '#S_Form', function(e){
            e.preventDefault();

            $AURL = $('#A_URL').val().trim();

            if($AURL.length <= 800 && $AURL.length != 0 && $AURL.match(/^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&\'\(\)\*\+,;=.]+$/)){
                $.ajax({
                    type: "POST",
                    url: "AJAX/URL-Insert.php",
                    data: { 'ENCODED_AURL' : encodeURIComponent($AURL) },
                    beforeSend: function() {
                        $('#Loader').show();
                        $('#S_BTN').prop('disabled', true).addClass('disable-icon');
                    },
                    complete: function() {
                        $('#Loader').hide();
                        $('#S_BTN').prop('disabled', false).removeClass('disable-icon');
                    },
                    success: function (response) {
                        $Res_Status = JSON.parse(response);
                        if($Res_Status.status == 800){
                            $('#S_Form').trigger('reset');
                            $('#Status').text('');
                            $("#Status").append("&#9989;   "+$Res_Status.msg+"   &#9989;").delay(0).fadeIn( "slow", function (){
                                $('#S_BTN').prop('disabled', true).addClass('disable-icon');
                                $('.View_Data').load('view_links.php');
                                $(this).delay(5000).fadeOut("slow", function(){
                                    $('#S_BTN').prop('disabled', false).removeClass('disable-icon');
                                    location.reload();
                                });
                            });
                        }else{
                            $('#Status').text('');
                            $('#Status').append("&#128545;"+$Res_Status.msg+"&#128545;");
                        }
                    }
                });
            }
            else{
                if($AURL.length == 0){
                    $('#Status').text('');
                    $('#Status').append("&#128545; Please Enter URL &#128545;");
                }
                else{
                    $('#Status').text('');
                    $('#Status').append("&#128545; Please Enter Valid URL &#128545;");
                }
            }

        }); 

    });
    </script>
</body>
</html>
