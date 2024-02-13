<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>IFJR - Carte De France</title>
		<link rel="stylesheet" id="amcharts2-style-demo-css" href="fichiers_carte/demo.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/carte.css" type="text/css" media="all">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="nav/nav.css"/>
      <link rel="stylesheet" href="footer/footer.css"/>
      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Montserrat';
    }
    </style>
    
	<body class="page-template-default page page-id-7030 notice-2 notice-present demo-theme-none scrolled">


  <?php include('nav/nav.php'); ?>
  
  <div class="container">
  <div class="row justify-content-end">
    <div class="col-auto">
      <div class="position-relative" style="top: 20px;">
        <div class="input-group">
          <div class="form-outline">
            <input type="search" name="rech" id="rechForm" class="form-control" placeholder="Rechercher une formation..." />
          </div>
          <button type="button" class="btn btn-dark" id="toto" type="button" data-toggle="modal" data-target="#myModal1">
            <svg class="bi bi-search" xlmns="http://wwww.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
            </svg>
            Rechercher
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
		<div id="result">
		</div>
    <div class="container">
        <img src="france.png" usemap="#image-map" class="maparea">

    <map name="image-map" >
      <area data-toggle="modal" data-target="#myModal1" alt="01 - Ain" onclick="departement('ain')" title="01 - Ain"  coords="783,480,794,469,798,458,798,446,783,457,769,454,760,462,748,443,725,437,713,490,724,501,733,505,745,507,754,496,763,512,775,515,781,502" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="02 - Aisne" onclick="departement('aisne')" title="02 - Aisne"  coords="637,203,639,187,639,173,659,167,660,147,671,138,666,114,633,108,606,108,598,128,601,172,590,175,596,190,609,206,624,220" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="03 - Allier" onclick="departement('allier')" title="03 - Allier"  coords="569,477,593,464,595,476,642,492,651,491,648,468,660,458,660,444,648,438,637,421,612,424,598,415,580,420,569,424,572,433,557,441,553,448,563,462" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="04 - Alpes-de-Haute-Provence"  onclick="departement('alpes-de-haute-provence')" title="04 - Alpes-de-Haute-Provence"  coords="865,608,862,629,853,655,863,676,850,689,809,698,792,697,778,689,769,667,778,658,794,651,794,641,804,629,819,636,822,626,842,629,848,618" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="05 - Hautes-Alpes" onclick="departement('hautes-alpes')" title="05 - Hautes-Alpes"  coords="784,657,792,649,801,631,818,634,822,624,841,625,847,615,868,601,857,586,841,566,818,566,821,581,789,601,786,611,777,611,774,624,766,621,765,636,775,645" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="06 - Alpes-Martimes" onclick="departement('alpes-maritimes')" title="06 - Alpes-Martimes"  coords="851,693,868,715,884,699,905,687,907,673,914,668,914,651,890,654,869,645,859,636,855,654,863,676" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="07 - Ardèche" title="07 - Ardèche"  onclick="departement('ardeche')" coords="715,643,716,608,725,591,714,549,697,559,690,570,683,588,670,591,657,605,666,633,671,644,683,647,697,647" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="08 - Ardennes" title="08 - Ardennes"  onclick="departement('ardennes')" coords="691,179,712,180,722,172,721,158,723,149,732,152,739,147,709,128,705,114,707,96,683,114,667,113,673,137,662,147,662,166,671,169" shape="poly">
      <area alt="09 - Ariège" data-toggle="modal" data-target="#myModal1" onclick="departement('ariege')" title="09 - Ariège" coords="452,790,471,800,485,797,492,807,508,807,517,811,541,801,536,794,529,795,522,788,530,784,527,763,510,749,488,745,478,758,461,760,464,769,452,777" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="10 - Aube" title="10 - Aube"  onclick="departement('aube')" coords="631,240,621,261,634,270,639,284,655,304,674,306,702,293,711,286,711,266,698,256,701,249,684,249,674,233,652,240,641,244" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="11 - Aude" title="11 - Aude"  onclick="departement('aude')" coords="543,804,557,800,552,790,582,787,592,781,601,787,599,769,608,756,590,739,585,749,573,745,571,734,547,730,534,732,522,731,512,748,526,760,530,783,522,787,536,794" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="12 - Aveyron" title="12 - Aveyron"  onclick="departement('aveyron')" coords="582,591,592,605,604,626,608,651,621,659,615,669,627,673,620,685,615,693,603,692,604,703,582,700,566,679,554,666,526,661,523,636,541,620,561,615,569,602,571,595" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="13 - Bouches-du-Rhône" title="13 - Bouches-du-Rhône"  onclick="departement('bouches-du-rhone')" coords="786,752,737,737,690,724,700,715,700,703,711,703,711,687,722,682,739,693,754,699,771,703,784,699,792,704,784,710,789,728,784,734,792,739" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="14 - Calvados" title="14 - Calvados"  onclick="departement('calvados')" coords="428,166,436,210,416,210,401,218,381,215,367,218,358,225,339,217,342,207,353,196,353,183,341,175,341,168,353,165,381,172,393,178" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="15 - Cantal" title="15 - Cantal"  onclick="departement('cantal')" coords="599,612,606,592,624,583,613,555,604,553,585,544,569,541,562,547,554,543,554,551,547,558,540,575,537,596,543,619,558,614,569,595,580,590" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="16 - Charente" title="16 - Charente"  onclick="departement('charente')" coords="454,478,463,491,453,492,456,501,440,513,433,522,432,530,416,539,416,550,409,560,400,560,381,551,381,534,374,520,370,506,388,506,394,487,409,476,425,480,436,476" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="17 - Charente-maritime" title="17 - Charente-maritime"  onclick="departement('charente-maritime')" coords="400,561,380,551,381,534,369,505,388,504,388,485,380,478,358,470,353,457,339,450,325,457,303,459,327,478,325,497,310,481,310,490,318,512,349,547,360,550,373,565,388,571,395,568" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="18 - Cher" title="18 - Cher"  onclick="departement('cher')" coords="590,348,593,356,590,363,597,375,601,411,569,424,572,432,551,446,542,449,545,431,538,412,542,403,535,383,521,382,530,369,542,366,546,351,539,340,551,335,568,342,578,345" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="19 - Corrèze" title="19 - Corrèze"  onclick="departement('correze')" coords="538,583,519,589,502,576,494,581,491,569,482,569,481,555,487,547,481,539,523,518,534,512,548,519,564,513,565,540,554,541,552,551" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="2A - Corse-du-Sud" title="2A - Corse-du-Sud"  onclick="departement('corse-du-sud')" coords="966,916,974,868,963,871,948,843,931,826,912,825,912,846,917,862,926,883,931,896" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="2B - Haute-Corse" title="2B - Haute-Corse"  onclick="departement('haute-corse')" coords="974,865,963,868,950,844,931,822,914,822,921,806,936,795,956,788,959,761,967,760,970,792,976,802,980,830,978,844" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="21 - Côte-d'Or" title="21 - Côte-d'Or"  onclick="departement('cote-dor')" coords="722,328,751,333,750,347,756,362,746,383,742,390,708,400,683,386,676,373,667,358,667,345,683,323,677,310,683,302,704,296,721,312" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="22 - Côtes-d'Armor" title="22 - Côtes-d'Armor"  onclick="departement('cotes-darmor')" coords="181,224,184,269,212,270,241,281,253,276,262,281,276,262,283,264,288,245,281,231,255,228,239,242,232,234,218,211,191,208" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="23 - Creuse" title="23 - Creuse"  onclick="departement('creuse')" coords="566,519,550,516,536,510,527,516,516,500,508,505,502,493,502,482,494,469,494,455,502,448,513,450,520,446,543,450,552,453,568,475,571,489,559,503" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="24 - Dordogne" title="24 - Dordogne"  onclick="departement('dordogne')" coords="481,541,487,547,480,552,481,568,491,569,495,580,487,600,471,621,454,617,446,611,423,614,416,604,416,593,401,597,402,572,395,569,398,561,409,561,416,549,416,540,429,533,430,524,440,516,449,519,453,526,466,524,475,533" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="25 - Doubs" title="25 - Doubs"  onclick="departement('doubs')" coords="798,427,796,418,803,411,799,402,789,398,788,388,774,384,779,376,770,364,814,339,833,334,851,341,852,355,834,383,819,390,819,409" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="26 - Drôme" title="26 - Drôme"  onclick="departement('drome')" coords="722,653,730,647,726,638,732,633,739,639,743,649,767,661,781,657,778,645,765,639,764,628,774,628,774,612,788,607,765,600,763,572,758,577,744,572,746,556,732,547,716,548,725,584,716,600,716,619,714,633,715,642" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="27 - Eure" title="27 - Eure"  onclick="departement('eure')" coords="429,167,433,209,459,235,491,227,501,210,499,200,508,198,515,182,515,168,501,164,473,177,459,165,442,158" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="28 - Eure-et-Loir" title="28 - Eure-et-Loir"  onclick="departement('eure-et-loir')" coords="461,237,467,249,467,262,454,265,460,283,487,303,501,299,520,293,530,273,529,259,520,256,517,248,508,235,502,210,492,226" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="29 - Finistère" title="29 - Finistère"  onclick="departement('finistere')" coords="180,224,184,266,171,270,174,283,192,292,182,301,178,308,131,299,108,275,136,270,118,252,110,245,111,230,136,223,159,217" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="30 - Gard" title="30 - Gard"  onclick="departement('gard')" coords="676,719,685,726,697,713,698,702,709,705,711,688,723,677,716,669,711,649,691,642,687,650,670,643,666,633,659,638,663,649,660,663,646,659,634,666,624,659,618,669,627,671,622,681,636,690,649,677,662,688,676,698,680,711" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="31 - Haute-Garonne" title="31 - Haute-Garonne"  onclick="departement('haute-garonne')" coords="427,800,436,799,453,788,454,776,462,772,462,761,472,758,482,760,485,747,495,750,509,746,520,733,531,730,524,722,514,713,502,688,490,687,482,697,462,695,475,713,462,733,446,732,424,753,435,768,433,782,422,782" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="32 - Gers" title="32 - Gers"  onclick="departement('gers')" coords="435,741,445,732,460,732,474,713,463,697,447,683,454,673,438,669,415,676,401,674,398,683,388,678,377,684,376,709,391,712,404,727,412,733" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="33 - Gironde" title="33 - Gironde"  onclick="departement('gironde')" coords="310,628,326,524,359,551,382,572,396,569,399,590,401,598,411,593,413,603,403,607,406,615,394,633,393,649,380,654,368,654,355,636,339,632,327,625" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="34 - Hérault" title="34 - Hérault"  onclick="departement('herault')" coords="611,753,669,719,678,712,673,698,650,677,639,690,625,684,614,692,603,691,606,702,597,705,578,712,578,725,568,729,569,740,579,744,592,734" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="35 - Ille-et-Vilaine" title="35 - Ille-et-Vilaine"  onclick="departement('ille-et-vilaine')" coords="283,233,283,262,271,268,262,290,274,301,269,314,274,327,297,320,313,308,324,315,332,297,341,294,337,270,338,249,330,244,320,251,309,237" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="36 - Indre" title="36 - Indre"  onclick="departement('indre')" coords="492,376,515,366,520,383,533,383,538,399,537,416,544,444,519,446,501,450,495,455,481,451,477,440,463,432,461,418,468,415,473,394,484,394" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="37 - Indre-et-Loire" title="37 - Indre-et-Loire"  onclick="departement('indre-et-loire')" coords="463,418,471,394,481,391,489,378,477,364,471,335,459,338,460,329,445,327,430,334,416,338,415,353,407,371,416,384,423,394,440,394" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="38 - Isère" title="38 - Isère"  onclick="departement('isere')" coords="788,607,767,600,763,572,757,576,746,570,746,558,732,547,718,547,716,537,723,531,716,524,732,519,739,512,736,502,753,499,774,517,777,533,789,538,796,531,809,540,809,558,814,565,813,573,823,583,806,591,795,593" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="39 - Jura" title="39 - Jura"  onclick="departement('jura')" coords="754,364,768,363,777,376,774,385,786,390,789,404,802,406,795,415,796,426,796,443,786,457,777,457,770,453,760,460,744,443,753,439,753,425,749,408,758,404,746,397,746,383" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="40 - Landes" title="40 - Landes"  onclick="departement('landes')" coords="289,716,311,718,337,715,376,712,376,684,387,677,395,678,401,666,388,654,369,654,353,638,327,624,311,628" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="41 - Loir-et-Cher" title="41 - Loir-et-Cher"  onclick="departement('loir-et-cher')" coords="501,299,487,306,460,286,459,308,445,322,459,327,460,336,470,334,477,369,488,374,516,364,523,374,540,364,545,350,540,339,547,334,533,331,519,334,515,327,508,324,505,311" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="42 - Loire" title="42 - Loire"  onclick="departement('loire')" coords="715,535,715,544,707,549,704,558,687,547,673,545,657,545,662,537,659,527,645,510,648,498,641,492,649,488,648,465,655,462,662,469,678,469,690,462,691,474,683,479,688,499,688,513,695,524,707,527" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="43 - Haute-Loire" title="43 - Haute-Loire"  onclick="departement('haute-loire')" coords="606,551,632,544,650,548,670,547,688,549,697,558,690,572,683,582,678,590,669,593,657,604,641,594,629,598,618,582,621,570" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="44 - Loire-Atlantique" title="44 - Loire-Atlantique"  onclick="departement('loire-atlantique')" coords="247,348,243,359,268,360,262,376,276,384,302,402,304,388,316,391,332,385,325,369,320,359,344,352,334,341,334,332,325,317,316,308,276,324,272,334" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="45 - Loiret" title="45 - Loiret"  onclick="departement('loiret')" coords="503,299,508,324,517,327,547,331,585,346,592,341,586,325,597,320,596,310,603,301,593,282,559,286,564,279,558,270,548,269,531,272,522,292" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="46 - Lot" title="46 - Lot"  onclick="departement('lot')" coords="536,586,545,618,526,628,522,642,506,652,491,656,474,649,464,629,473,617,485,605,494,591,491,582,502,579,516,591,523,586" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="47 - Lot-et-Garonne" title="47 - Lot-et-Garonne"  onclick="departement('lot-et-garonne')" coords="398,671,402,663,386,653,394,649,391,633,407,615,405,607,414,604,422,612,439,612,452,612,466,617,463,626,467,639,456,638,457,652,454,663,445,669,415,674" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="48 - Lozère" title="48 - Lozère"  onclick="departement('lozere')" coords="614,656,631,664,643,659,657,661,663,649,659,639,663,632,656,607,641,596,629,598,620,586,607,593,599,614" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="49 - Maine-et-Loire" title="49 - Maine-et-Loire"  onclick="departement('maine-et-loire')" coords="325,315,335,334,345,352,323,360,332,383,346,391,365,388,395,384,407,374,414,355,416,336,386,324,376,318,360,320" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="50 - Manche" title="50 - Manche"  onclick="departement('manche')" coords="311,235,320,251,330,242,339,248,353,247,362,231,355,224,344,221,338,214,349,206,353,182,341,177,341,168,328,151,332,139,295,130,297,153,310,188" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="51 - Marne" title="51 - Marne"  onclick="departement('marne')" coords="622,219,628,242,641,245,674,233,680,242,702,248,719,234,714,221,714,213,721,202,715,181,700,179,683,175,660,167,648,165,634,171,641,186,636,202" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="52 - Haute-Marne" title="52 - Haute-Marne"  onclick="departement('haute-marne')" coords="702,249,718,235,749,255,764,277,777,299,767,313,767,324,751,327,742,336,725,328,718,317,722,310,704,293,711,284,712,265" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="53 - Mayenne" title="53 - Mayenne"  onclick="departement('mayenne')" coords="339,252,341,292,331,297,324,317,360,320,381,320,384,296,402,263,395,247,374,252,353,248" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="54 - Meurthe-et-Moselle" title="54 - Meurthe-et-Moselle"  onclick="departement('meurthe-et-moselle')" coords="746,156,746,164,756,160,770,193,767,212,770,248,778,256,823,249,837,251,851,242,831,228,806,219,782,200,778,186,778,172,774,158,758,149" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="55 - Meuse" title="55 - Meuse"  onclick="departement('meuse')" coords="751,255,765,249,767,214,768,195,754,161,747,167,743,154,739,144,728,147,719,156,723,168,716,179,722,200,714,214,719,235" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="56 - Morbihan" title="56 - Morbihan"  onclick="departement('morbihan')" coords="173,273,175,286,188,292,180,307,204,335,248,342,269,332,269,317,275,306,269,293,261,292,265,282,253,275,244,279,227,272,208,275,185,266" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="57 - Moselle" title="57 - Moselle"  onclick="departement('moselle')" coords="782,202,856,242,865,219,849,212,842,206,849,191,876,200,882,188,838,177,823,179,814,160,777,156" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="58 - Nièvre" title="58 - Nièvre"  onclick="departement('nievre')" coords="590,343,599,418,628,426,642,419,662,415,663,387,676,377,667,362,655,362,652,353,641,353,631,343,622,348,604,339" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="59 - Nord" title="59 - Nord"  onclick="departement('nord')" coords="543,18,558,39,557,49,585,49,585,60,596,70,604,88,594,98,601,107,662,111,667,88,629,64,597,38,575,35,568,10" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="60 - Oise" title="60 - Oise"  onclick="departement('oise')" coords="517,137,521,161,516,169,518,180,517,189,537,186,552,189,572,200,604,196,594,187,594,176,602,166,600,137,573,147,553,139,536,139" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="61 - Orne" title="61 - Orne"  onclick="departement('orne')" coords="356,248,374,251,393,245,402,256,409,259,416,251,426,252,433,269,459,282,454,268,464,262,466,249,456,237,454,226,436,214,436,206,418,209,398,219,381,214,367,217,358,223,360,234" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="62 - Pas-de-Calais" title="62 - Pas-de-Calais"  onclick="departement('pas-de-calais')" coords="599,105,592,98,604,90,587,64,583,46,557,49,540,18,506,27,505,74,520,74,536,88,559,90,557,102,575,100,583,102" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="63 - Puy-de-Dôme" title="63 - Puy-de-Dôme"  onclick="departement('puy-de-dome')" coords="592,464,599,479,625,481,643,495,643,507,649,520,660,528,662,548,641,548,621,540,604,549,586,544,568,538,564,517,558,506,572,492,571,478,579,469" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="64 - Pyrénées-Atlantiques" title="64 - Pyrénées-Atlantiques"  onclick="departement('pyrenees-atlantique')" coords="369,781,372,762,391,740,388,727,388,715,289,719,269,730,290,761,339,769,346,788,359,788" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="65 - Hautes-Pyrénées" title="65 - Hautes-Pyrénées"  onclick="departement('hautes-pyrenees')" coords="390,712,391,739,376,758,372,782,386,799,422,797,422,785,430,782,436,775,425,758,435,743,409,734,401,720" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="66 - Pyrénées-Orientales" title="66 - Pyrénées-Orientales"  onclick="departement('pyrenees-orientales')" coords="536,803,555,800,551,789,580,786,589,779,601,786,608,825,571,834,531,830,513,811" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="67 - Bas-Rhin" title="67 - Bas-Rhin"  onclick="departement('bas-rhin')" coords="883,275,856,262,852,244,865,221,844,207,849,192,873,200,882,192,893,184,917,193" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="68 - Haut-Rhin" title="68 - Haut-Rhin"  onclick="departement('haut-rhin')" coords="858,261,840,307,854,318,854,329,861,339,877,341,883,328,880,313,883,293,882,276" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="69 - Rhône" title="69 - Rhône" onclick="departement('rhone')"  coords="708,538,721,533,718,527,732,522,740,513,735,505,726,505,715,494,715,472,710,461,691,460,693,472,686,473,682,483,690,501,690,511,687,517,698,526,708,529" shape="poly">      <area data-toggle="modal" data-target="#myModal1" alt="70 - Haute-Saône" title="70 - Haute-Saône"  onclick="departement('haute-saone')" coords="753,334,749,343,757,362,768,364,810,341,823,339,834,328,840,310,823,300,809,299,795,292,781,299,768,313,770,322,757,325" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="71 - Saône-et-Loire" title="71 - Saône-et-Loire"  onclick="departement('saone-et-loire')" coords="688,468,662,468,650,461,662,454,662,443,646,439,638,419,662,416,663,388,676,380,708,401,744,392,753,404,750,416,754,437,746,441,730,437,714,467,709,457,690,458" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="72 - Sarthe" title="72 - Sarthe"  onclick="departement('sarthe')" coords="381,327,386,293,402,263,414,252,426,252,430,268,459,283,459,306,446,325,430,334,418,339" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="73 - Savoie" title="73 - Savoie"  onclick="departement('savoie')" coords="784,491,771,517,777,537,792,540,792,530,809,540,809,561,830,569,838,565,870,548,870,535,859,514,848,502,835,498,830,489,817,509,802,506,793,502" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="74 - Haute-Savoie" title="74 - Haute-Savoie"  onclick="departement('haute-savoie')"coords="781,475,784,489,796,503,814,506,830,489,845,502,851,495,859,489,848,440,820,441,812,461,789,468" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="75 - Paris" title="75 - Paris"  onclick="departement('paris')" coords="89,74,76,71,61,78,41,64,52,53,73,52,79,62" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="76 - Seine-Maritime" title="76 - Seine-Maritime"  onclick="departement('seine-maritime')" coords="415,158,429,164,440,158,473,179,487,172,495,161,513,167,520,161,515,144,517,135,515,121,496,102,481,115,432,130,419,140" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="77 - Seine-et-Marne" title="77 - Seine-et-Marne"  onclick="departement('seine-et-marne')" coords="568,202,569,231,565,261,558,272,565,280,571,286,592,282,597,270,618,263,627,242,621,217,604,198" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="78 - Yvelines" title="78 - Yvelines"  onclick="departement('yvelines')" coords="537,237,545,228,545,214,540,206,522,200,508,196,501,199,501,209,508,224,508,234,517,248,520,256,527,259,529,249" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="79 - Deux-Sèvres" title="79 - Deux-Sèvres"  onclick="departement('deux-sevres')" coords="346,392,355,408,367,447,353,455,360,469,395,488,414,474,409,458,400,441,400,427,398,394,391,383,369,383,363,392,353,390" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="80 - Somme" title="80 - Somme"  onclick="departement('somme')" coords="505,74,494,102,516,119,517,137,555,137,572,147,599,137,604,109,575,98,558,102,558,90,537,88,520,76" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="81 - Tarn" title="81 - Tarn"  onclick="departement('tarn')" coords="503,690,510,712,530,732,544,733,571,732,578,725,573,716,578,709,592,705,579,699,566,678,557,669,538,660,529,663,508,669" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="82 - Tarn-et-Garonne" onclick="departement('tarn-et-garonne')" title="82 - Tarn-et-Garonne"  coords="501,685,480,698,460,698,452,684,445,670,454,661,457,643,470,640,482,653,498,653,522,645,529,661,508,669" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="83 - Var" title="83 - Var"  onclick="departement('var')" coords="789,698,786,753,819,761,851,746,866,716,863,705,851,688,827,691,817,692,809,698,798,692" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="84 - Vaucluse" title="84 - Vaucluse"  onclick="departement('vaucluse')" coords="788,697,772,702,753,699,723,681,723,673,715,666,709,646,718,645,726,650,730,635,739,636,737,647,746,645,753,652,761,657,770,661,771,676,775,685" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="85 - Vendée" title="85 - Vendée"  onclick="departement('vendee')" coords="353,457,339,450,325,454,289,446,265,405,269,383,300,398,304,384,311,394,314,387,325,383,345,390,349,402,366,446" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="86 - Vienne" title="86 - Vienne"  onclick="departement('vienne')" coords="397,390,408,376,422,397,442,391,459,422,463,433,480,451,456,462,454,474,435,475,412,476,411,458,402,453,400,432,404,418" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="87 - Haute-Vienne" title="87 - Haute-Vienne"  onclick="departement('haute-vienne')" coords="457,462,454,481,461,493,445,510,452,523,467,524,475,533,484,538,522,516,526,506,515,502,506,495,496,474,495,454,480,453" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="88 - Vosges" title="88 - Vosges"  onclick="departement('vosges')" coords="750,261,767,277,767,292,774,300,792,294,810,299,823,299,838,307,847,294,851,284,858,263,852,245,834,252,824,249,795,254,785,258,777,248,763,248" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="89 - Yonne" title="89 - Yonne"  onclick="departement('yonne')" coords="594,283,606,300,596,310,596,321,586,324,593,341,618,348,627,341,642,353,662,362,667,352,678,322,678,307,656,306,648,290,638,284,634,273,620,263,606,263,596,269" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="90 - Territoire de Belfort" title="90 - Territoire de Belfort"  onclick="departement('territoire_de_belfort')" coords="852,342,837,334,837,314,842,307,851,320,863,341" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="91 - Essone" title="91 - Essone"  onclick="departement('essone')" coords="557,269,533,273,527,260,536,245,536,238,543,231,568,232,566,248,565,260" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="92 - Hauts-de-Seine" title="92 - Hauts-de-Seine" onclick="departement('hauts-de-seine')"  coords="59,78,59,98,41,86,27,64,34,44,58,30,62,49,49,56,40,63,45,72" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="93 - Seine-Saint-Denis" title="93 - Seine-Saint-Denis"  onclick="departement('seine-saint-denis')" coords="59,32,63,49,73,49,77,64,87,61,115,77,110,18,84,30" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="94 - Val-de-Marne" title="94 - Val-de-Marne"  onclick="departement('val-de-marne')" coords="59,77,73,75,87,77,89,68,115,79,107,106,75,102,59,98" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="95 - Val-d'Oise" title="95 - Val-d'Oise"  onclick="departement('val-doise')" coords="510,199,533,204,543,211,568,207,568,197,557,189,547,189,536,186,513,185" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="971 - Guadeloupe" title="971 - Guadeloupe"  onclick="departement('guadeloupe')" coords="24,854,24,898,86,905,89,854" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="972 - Martinique" title="972 - Martinique"  onclick="departement('martinique')" coords="122,850,125,908,181,909,188,853" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="973 - Guyane" title="973 - Guyane"  onclick="departement('guyane')" coords="208,853,208,915,262,913,267,854" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="974 - La Réunion" title="974 - La Réunion"  onclick="departement('la-reunion')" coords="297,852,296,906,359,910,356,856" shape="poly">
      <area data-toggle="modal" data-target="#myModal1" alt="976 - Mayotte" title="976 - Mayotte"  onclick="departement('mayotte')" coords="388,857,384,909,447,905,450,861" shape="poly">
    </map>
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="Ant"></h5>
            </div>
            <div id="yes">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
          </div>
        </div>
    </div>
    </div>
    

    <script src="recherche.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/maphilight/1.4.0/jquery.maphilight.min.js"></script>
    <script>
      $(function() {
          $('.maparea').maphilight();
      });
    </script>
    
    <?php include('footer/footer.php'); ?>
  </body>
</html>
