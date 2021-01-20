<?php
//Steps to publish prepare SpreadSheet for using JSON
//https://www.freecodecamp.org/news/cjn-google-sheets-as-json-endpoint/
function get_data($sp_key)
{

    // construct Google spreadsheet URL:
    $url = "https://spreadsheets.google.com/feeds/cells/{$sp_key}/1/public/basic?alt=json-in-script&callback=_";

    // UA
    $userAgent = "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.9) Gecko/20100315 Firefox/3.5.9";
    $curl = curl_init();
    // set URL
    curl_setopt($curl, CURLOPT_URL, $url);

    // setting curl options
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // return page to the variable
    //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // allow redirects
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // return into a variable
    curl_setopt($curl, CURLOPT_TIMEOUT, 30000); // times out after 4s
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);

    // grab URL and pass it to the variable
    $str = curl_exec($curl);
    curl_close($curl);

    $str = mb_ereg_replace("// API callback\n_\(", "", $str);
    $str = mb_ereg_replace("\)\;$", "", $str);
    //echo $str;
    $data = json_decode($str, true);
    $id_marker = "https://spreadsheets.google.com/feeds/cells/{$sp_key}/1/public/basic/";
    $entries = $data["feed"]["entry"];
    $res = array();
    foreach ($entries as $entry) {
        $content = $entry["content"];
        $ind = str_replace($id_marker . "R", "", $entry["id"]['$t']);
        $ii = explode("C", $ind);
        $res[$ii[0] - 1][$ii[1] - 1] = $entry["content"]['$t'];
    }

    return $res;
}

function display_news($news) {
    [$title, $summary, $ccount, $img] = $news;
    echo '
    <div class="bg2-featurebox-4">
                            <div class="col-md-5 col-sm-12 col-xs-12 margin-bottom">
                                <img src="'.$img.'" alt="" class="img-responsive" style="background-image:http://placehold.it/1000x800"/>
                            </div>

                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <h4 class="dosis uppercase title">
                                    <a href="#">'.$title.'</a>
                                </h4>
                                <div class="blog-post-info">
                                    <span><i class="fa fa-comments-o"></i> '.$ccount.' Comments</span>
                                </div>
                                <p> '.$summary.'                               
                                </p>
                                <a class="btn btn-dark-3 btn-small" href="#">Read more</a>
                            </div>
                        </div>
                        <div class="col-divider-margin-3"></div>';
}
