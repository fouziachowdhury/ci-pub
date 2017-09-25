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
$route['LOGIN_PAGE'] = 'examples/login';
$route['registrationform'] = 'mainfront/memberregistration';
$route['insertmember'] = 'members/insertmember';
$route['memberprofile/(:any)'] = 'members/memberprofile/$1';
$route['changepassword/(:any)'] = 'members/changepassword/$1';
$route['editaccount/(:any)'] = 'members/accounteditform/$1';
$route['updateprofile/(:any)'] = 'members/updateprofile/$1';
$route['loginform'] = 'mainfront/memberlogin';
$route['loginmember'] = 'members/loginmember';
$route['memberlogout'] = 'members/logoutmember';
$route['memberactivate/(:any)'] = 'members/activatemember/$1';
$route['thankyoupage'] = 'members/thankyoupage';


$route['forgetpassword'] = 'mainfront/memberforgetpass';



//WHOIS
$route['whois'] = 'whois/whoispackeges';
$route['activewhoisgold/(:any)'] = 'whois/activewhoisgold/$1';
$route['activewhoissilver/(:any)'] = 'whois/activewhoissilver/$1';
$route['activewhoisplatinum/(:any)'] = 'whois/activewhoisplatinum/$1';

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


//CONTACT
$route['contactwithus'] = 'mainfront/contactwithus';

//TERMS
$route['siteterms'] = 'mainfront/siteterms';

//PRIVACY
$route['siteprivacy'] = 'mainfront/siteprivacy';

//LANDING PAGE
$route['landingpage'] = 'landingpage/showlandingpage';
$route['landingpagecommentmodal'] = 'landingpage/landingcommentmodal';
$route['landingsearch'] = 'landingpage/landingsearch';
$route['searchlandingbyentries'] = 'landingpage/searchlandingbyentries';

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
$route['loadmorebanners'] = 'banners/loadmorebanner';
$route['bannersearch'] = 'banners/bannersearch';
$route['makebannerfavorites/(:any)/(:any)'] = 'banners/makefavorites/$1/$2';

//DIRECTORY
$route['showdirectory'] = 'directory/showdirectory';
$route['showdirectory'] = 'nativadd/showdirectory';

//NATIV ADDs SECTION
$route['netivAddSec'] = 'nativadd/shownetivaddsec';
$route['makenativaddsfavorites/(:any)/(:any)'] = 'nativadd/makefavorites/$1/$2';
$route['loadmorenativadds'] = 'nativadd/loadmorenativadds';
$route['nativaddssearch'] = 'nativadd/nativaddssearch';


//COMMENTS 
$route['addComments'] = 'comments/addComments';
$route['addLandingComments'] = 'comments/addLandingComments';

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
