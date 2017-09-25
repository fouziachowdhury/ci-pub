<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'mainfront';

//FRONT 
$route['default_controller'] = 'mainfront/home';
$route['home'] = 'mainfront/home';
$route['userhome'] = 'mainfront/userhome';
$route['userhome/(:any)'] = 'mainfront/userhome/$1';
$route['LOGIN_PAGE'] = 'examples/login';
$route['registrationform'] = 'mainfront/memberregistration';
$route['insertmember'] = 'members/insertmember';
$route['memberprofile/(:any)'] = 'members/memberprofile/$1';
$route['changepassword/(:any)'] = 'members/changepassword/$1';
$route['editaccount/(:any)'] = 'members/accounteditform/$1';
$route['accounteditform'] = 'members/accounteditform';
$route['updateprofile/(:any)'] = 'members/updateprofile/$1';
$route['loginform'] = 'mainfront/memberlogin';
$route['loginmember'] = 'members/loginmember';
$route['memberlogout'] = 'members/logoutmember';
$route['memberactivate/(:any)/(:any)'] = 'members/activatemember/$1/$1';
// $route['memberactivate/(:any)'] = 'members/activatemember/$1';
$route['thankyoupage'] = 'members/thankyoupage';
$route['myaccount/(:any)'] = 'members/myaccount/$1';
$route['forgetpassword'] = 'mainfront/memberforgetpass';



//WHOIS
$route['whois'] = 'whois/whoispackeges';
$route['activewhoisgold/(:any)'] = 'whois/activewhoisgold/$1';
$route['activewhoissilver/(:any)'] = 'whois/activewhoissilver/$1';
$route['activewhoisplatinum/(:any)'] = 'whois/activewhoisplatinum/$1';
$route['getwhoisinfo/(:any)'] = 'whois/getwhoisinfo/$1';
$route['whoiscontactinfomodal'] = 'whois/whoiscontactinfomodal';

//Whois User Panel
$route['viewWhois/(:any)'] = 'whois/viewWhois/$1';
$route['whoisDns'] = 'whois/whoisDns';

//NETWORK
$route['network'] = 'network/networkpackeges';
$route['userhomenetwork'] = 'network/userhomenetworkpackeges';
$route['selectcustompackageoption'] = 'network/selectcustompackageoption';
$route['approveNetworkPackage/(:any)'] = 'network/approvepackage/$1';
$route['payfornetwork'] = 'network/payfornetwork';

//AFFILIATE
$route['affiliate'] = 'affiliate/affiliatepackeges';
$route['custompackageforaffiliate'] = 'affiliate/custompackageforaffiliate';
$route['superpackageforaffiliate/(:any)'] = 'affiliate/superpackageforaffiliate/$1';
$route['payforaffiliate'] = 'affiliate/payforaffiliate';
$route['affiliatefeed'] = 'affiliate/affiliatefeed';
$route['affiliatefeed/(:any)'] = 'affiliate/affiliatefeed/$1';
$route['searchafffeedbymyfavoffer'] = 'affiliate/searchafffeedbymyfavoffer';
$route['searchafffeedbymycom'] = 'affiliate/searchafffeedbymycom';
$route['searchafffeedbycatid'] = 'affiliate/searchafffeedbycatid';
$route['searchafffeedbycountryid'] = 'affiliate/searchafffeedbycountryid';
$route['searchafffeedbyentries'] = 'affiliate/searchafffeedbyentries';
$route['afffeedTagTagAutocomplete'] = 'affiliate/afffeedTagTagAutocomplete';
$route['searchafffeedTagbyautokey'] = 'affiliate/searchafffeedTagbyautokey';
$route['feedcommentmodal'] = 'affiliate/feedcommentmodal';

$route['activefreepackage'] = 'affiliate/activefreepackage';


$route['offerfeed'] = 'affiliate/offerfeed';
$route['offerfeed/(:any)'] = 'affiliate/offerfeed/$1';
$route['searchlandingbymyfavoffer'] = 'affiliate/searchlandingbymyfavoffer';
$route['searchlandingbymycomoffer'] = 'affiliate/searchlandingbymycomoffer';
$route['searchofferbycatid'] = 'affiliate/searchofferbycatid';
$route['searchofferbycountryid'] = 'affiliate/searchofferbycountryid';
$route['searchofferbyentries'] = 'affiliate/searchofferbyentries';
$route['offerTagAutocomplete'] = 'affiliate/offerTagAutocomplete';
$route['searchofferbyautokey'] = 'affiliate/searchofferbyautokey';
$route['offercommentmodal'] = 'affiliate/offercommentmodal';

$route['freepack/(:any)'] = 'affiliate/freepack/$1';


$route['offerFeedByCategory/(:any)'] = 'affiliate/offerFeedByCategory/$1';
$route['offerFeedByCountry/(:any)'] = 'affiliate/offerFeedByCountry/$1';
$route['offerFeedByTag/(:any)'] = 'affiliate/offerFeedByTag/$1';

$route['searchFilterData'] = 'landingpage/search_filter_data';

//CONTACT
$route['contactwithus'] = 'mainfront/contactwithus';

//TERMS
$route['siteterms'] = 'mainfront/siteterms';

//PRIVACY
$route['siteprivacy'] = 'mainfront/siteprivacy';

//LANDING PAGE
$route['landingpage'] = 'landingpage/showlandingpage';
$route['landingpage/(:any)'] = 'landingpage/showlandingpage/$1';
$route['landingpagecommentmodal'] = 'landingpage/landingcommentmodal';
$route['landingsearch'] = 'landingpage/landingsearch';
$route['searchlandingbyentries'] = 'landingpage/searchlandingbyentries';
$route['landingTagAutocomplete'] = 'landingpage/landingTagAutocomplete';
$route['searchlandingbyautokey'] = 'landingpage/searchlandingbyautokey';
$route['searchlandingbymyfav'] = 'landingpage/searchlandingbymyfav';
$route['searchlandingbymycom'] = 'landingpage/searchlandingbymycom';

$route['landingdownloadcheck'] = 'landingpage/landingdownloadcheck';
$route['landingdownloadnumberadd'] = 'landingpage/landingdownloadnumberadd';

$route['landingByCategory/(:any)'] = 'landingpage/landingByCategory/$1';
$route['landingByCountry/(:any)'] = 'landingpage/landingByCountry/$1';
$route['landingByTag/(:any)'] = 'landingpage/landingByTag/$1';

$route['searchFilterDataByKeyword'] = 'landingpage/search_filter_data_by_keyword';

//FOR PAGE COUNT
$route['pagecount'] = 'mainfront/pageviewcount';
$route['accesspage'] = 'mainfront/pageaccesspermission';


//PAYPAL
$route['paypalform/(:any)'] = 'paypal/paypalform/$1';
$route['paypal_notification'] = 'paypal/paypalnotification';
$route['paypal_return_notify'] = 'paypal/paypalreturnnotify';
$route['paypal_cancle_notify'] = 'paypal/paypalcanclenotify';

//STRIPE
$route['stripeform/(:any)'] = 'stripe/stripeform/$1';
$route['paymentwithstripe'] = 'stripe/paymentwithstripe';
$route['supaffpaymentwithstripe'] = 'stripe/supaffpaymentwithstripe';
$route['getwebhookresult'] = 'stripe/getwebhookresult';

//BANNERS
$route['allbanners'] = 'banners/showallbanners';
$route['allbannerstest'] = 'banners/showallbannersTest';
$route['allbannerstest/(:any)'] = 'banners/showallbannersTest/$1';
$route['loadmorebanners'] = 'banners/loadmorebanner';
$route['bannersearch'] = 'banners/bannersearch';
$route['makebannerfavorites/(:any)/(:any)'] = 'banners/makefavorites/$1/$2';
$route['bannerTagAutocomplete'] = 'banners/bannerTagAutocomplete';
$route['bannercommentmodal'] = 'banners/bannercommentmodal';
$route['searchbannerbyentries'] = 'banners/searchbannerbyentries';
$route['searchbannerbyautokey'] = 'banners/searchbannerbyautokey';
$route['searchbannerbycatid'] = 'banners/searchbannerbycatid';
$route['searchbannerbycountryid'] = 'banners/searchbannerbycountryid';
$route['searchbannerbysize'] = 'banners/searchbannerbysize';
$route['favbannerbyuser'] = 'banners/favbannerbyuser';
$route['favbannerbyuser/(:any)'] = 'banners/favbannerbyuser/$1';
$route['searchbanbymyfav'] = 'banners/searchbanbymyfav';
$route['searchbanbymycom'] = 'banners/searchbanbymycom';
$route['downloadcheck'] = 'banners/downloadcheck';
$route['downloadnumberadd'] = 'banners/downloadnumberadd';


//DIRECTORY
$route['showdirectory'] = 'directory/showdirectory';
$route['showdirectory'] = 'nativadd/showdirectory';

//NATIV ADDs SECTION
$route['netivAddSec'] = 'nativadd/shownetivaddsec';
$route['netivAddSec/(:any)'] = 'nativadd/shownetivaddsec/$1';
$route['makenativaddsfavorites/(:any)/(:any)'] = 'nativadd/makefavorites/$1/$2';
$route['loadmorenativadds'] = 'nativadd/loadmorenativadds';
$route['nativaddssearch'] = 'nativadd/nativaddssearch';
$route['searchnativbymyfav'] = 'nativadd/searchnativbymyfavban';
$route['searchnativbymycom'] = 'nativadd/searchnativbymycomban';

$route['nativTagAutocomplete'] = 'nativadd/nativTagAutocomplete';
$route['searchnativbyautokey'] = 'nativadd/searchnativbyautokey';

$route['nativeCommentModal'] = 'nativadd/nativeCommentModal';

//FACEBOOK ADDS SECTION
$route['facebookSec'] = 'facebookadds/facebookaddsSec';
$route['facebookSec/(:any)'] = 'facebookadds/facebookaddsSec/$1';
$route['searchfbbyentries'] = 'facebookadds/searchfbbyentries';

$route['searchfbecobyautokey'] = 'facebookadds/searchfbecobyautokey';
$route['searchfbbycatid'] = 'facebookadds/searchfbbycatid';
$route['searchfbbycountryid'] = 'facebookadds/searchfbbycountryid';
$route['fbTagAutocomplete'] = 'facebookadds/fbTagAutocomplete';

$route['searchfbbymyfav'] = 'facebookadds/searchfbbymyfav';
$route['searchfbbymycom'] = 'facebookadds/searchfbbymycom';
$route['makefbfavorites'] = 'facebookadds/makefbfavorites';
$route['fbcommentmodal'] = 'facebookadds/fbcommentmodal';
$route['addFBComments'] = 'comments/addFBComments';

//FACEBOOK ECOMMERCE SECTION
$route['faceecomerceSec'] = 'fbecommerceadds/faceecomerceSec';
$route['faceecomerceSec/(:any)'] = 'fbecommerceadds/faceecomerceSec/$1';
$route['searchfbaddsbyentries'] = 'facebookadds/searchfbaddsbyentries';

$route['searchfbecobyentries'] = 'fbecommerceadds/searchfbecobyentries';
$route['searchfbecobyautokey'] = 'fbecommerceadds/searchfbecobyautokey';
$route['searchfbecobycatid'] = 'fbecommerceadds/searchfbecobycatid';
$route['searchfbecobycountryid'] = 'fbecommerceadds/searchfbecobycountryid';
$route['fbecoTagAutocomplete'] = 'fbecommerceadds/fbecoTagAutocomplete';
$route['addEcoComments'] = 'comments/addEcoComments';
$route['fbecocommentmodal'] = 'fbecommerceadds/fbecocommentmodal';



//PPV ADS SECTION

$route['ppvAddSec'] = 'ppv/showallppv';
$route['ppvAddSec/(:any)'] = 'ppv/showallppv/$1';
$route['ppvcommentmodal'] = 'ppv/ppvcommentmodal';
$route['addPPVComments'] = 'comments/addPPVComments';

//$route['searchfbaddsbyentries'] = 'facebookadds/searchfbaddsbyentries';
//
$route['searchppvbyentries'] = 'ppv/searchppvbyentries';
$route['searchppvbyautokey'] = 'ppv/searchppvbyautokey';
$route['searchppvbycatid'] = 'ppv/searchppvbycatid';
$route['searchppvbycountryid'] = 'ppv/searchppvbycountryid';
$route['ppvTagAutocomplete'] = 'ppv/ppvTagAutocomplete';

$route['searchppvbymycom'] = 'ppv/searchppvbymycom';
$route['searchppvbymyfav'] = 'ppv/searchppvbymyfav';

$route['ppvByCategory/(:any)'] = 'ppv/ppvByCategory/$1';
$route['ppvByCountry/(:any)'] = 'ppv/ppvByCountry/$1';
$route['ppvByTag/(:any)'] = 'ppv/ppvByTag/$1';

//COMMENTS 
$route['addComments'] = 'comments/addComments';
$route['addLandingComments'] = 'comments/addLandingComments';
$route['addBannerComments'] = 'comments/addBannerComments';
$route['deleteComment/(:any)/(:any)'] = 'comments/deleteComment/$1/$2';


//Resource SECTION
$route['showaffiliatenetwork'] = 'resource/showaffiliatenetwork';
$route['showaffiliatenetwork/(:any)'] = 'resource/showaffiliatenetwork/$1';
$route['showaddnetwork'] = 'resource/showaddnetwork';
$route['showaddnetwork/(:any)'] = 'resource/showaddnetwork/$1';
$route['showhosting'] = 'resource/showhosting';
$route['showhosting/(:any)'] = 'resource/showhosting/$1';
$route['showtraking'] = 'resource/showtraking';
$route['showtraking/(:any)'] = 'resource/showtraking/$1';

$route['showcoaching'] = 'resource/showcoaching';
$route['showcoaching/(:any)'] = 'resource/showcoaching/$1';
$route['showforums'] = 'resource/showforums';
$route['showforums/(:any)'] = 'resource/showforums/$1';
$route['showblogs'] = 'resource/showblogs';
$route['showblogs/(:any)'] = 'resource/showblogs/$1';

$route['resourcecommentmodal'] = 'resource/resourcecommentmodal';
$route['makefavoritesresource/(:any)/(:any)'] = 'resource/makefavoritesresource/$1/$2';


$route['resource/searchFilterData'] = 'resource/searchFilterData';
$route['resource/resourceTagAutocomplete'] = 'resource/resourceTagAutocomplete';
$route['resource/searchbymyfav'] = 'resource/searchbymyfav';
$route['resource/searchbymycom'] = 'resource/searchbymycom';

$route['resource/adNetworksTagAutocomplete'] = 'resource/adNetworksTagAutocomplete';
$route['resource/searchNetworkFilterData'] = 'resource/searchNetworkFilterData';
$route['resource/hostingTagAutocomplete'] = 'resource/hostingTagAutocomplete';
$route['resource/trackingTagAutocomplete'] = 'resource/trackingTagAutocomplete';
$route['resource/coachingTagAutocomplete'] = 'resource/coachingTagAutocomplete';
$route['resource/forumsTagAutocomplete'] = 'resource/forumsTagAutocomplete';
$route['resource/blogsTagAutocomplete'] = 'resource/blogsTagAutocomplete';


//SERVICES SECTION
$route['showbandesign'] = 'service/showbandesign';
$route['showbandesign/(:any)'] = 'service/showbandesign/$1';
$route['showprogramming'] = 'service/showprogramming';
$route['showprogramming/(:any)'] = 'service/showprogramming/$1';
$route['showmanagement'] = 'service/showmanagement';
$route['showmanagement/(:any)'] = 'service/showmanagement/$1';
$route['showtranslation'] = 'service/showtranslation';
$route['showtranslation/(:any)'] = 'service/showtranslation/$1';


//ERROR
$route['loginerror'] = 'mainfront/withoutlogin';
$route['permissionerror'] = 'mainfront/permissionerror';




//Admin Panel

$route['user/(:any)'] = 'admin/allUser';
$route['category/(:any)'] = 'admin/allCategory';
$route['banner/(:any)'] = 'admin/banner';
$route['facebook/(:any)'] = 'admin/addFacebook';
$route['landing/(:any)'] = 'admin/addLanding';
$route['resource/(:any)'] = 'admin/resourceAffiliate';
$route['service/(:any)'] = 'admin/serviceBanner';

//End Admin Panel
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
