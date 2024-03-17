<?php

function make_slug($word){
  $word = str_replace(array("ü","Ü"),"u",$word);
  $word = str_replace(array("Ə","ə"),"e",$word);
  $word = str_replace(array("Ö","ö"),"o",$word);
  $word = str_replace(array("Ş","ş"),"sh",$word);
  $word = str_replace(array("Ç","ç"),"ch",$word);
  $word = str_replace("İ","i",$word);
  $word = str_slug($word);
  return $word;
}
function update_sitemap(){
  $date = date("Y-m-d");
  $home = "<url>\n<loc>https://sade.store/</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>1.00</priority>\n</url>";
  $all_news = "<url>\n<loc>https://sade.store/all-news</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.80</priority>\n</url>";
  $check = "<url>\n<loc>https://sade.store/check</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.80</priority>\n</url>";
  $contact = "<url>\n<loc>https://sade.store/contact</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.80</priority>\n</url>";
  $acc = "<url>\n<loc>https://sade.store/login</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.80</priority>\n</url>\n<url>\n<loc>https://sade.store/register</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.80</priority>\n</url>";
  $pros = "";$news = "";$pages = "";$cats = ""; $subs = "";
  $products = App\ProductDetails::all();$ns = App\News::all();$pgs = App\Page::all();
  $scs = App\Subcat::all(); $cts = App\Category::all();
  foreach ($products as $key => $product) {$pros .= "<url>\n<loc>https://sade.store/product-details/".$product->slug."</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.64</priority>\n</url>";}
  foreach ($ns as $n) {$news .= "<url>\n<loc>https://sade.store/news/".$n->slug."</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.56</priority>\n</url>";}
  foreach ($pgs as $pg) {$pages .= "<url>\n<loc>https://sade.store/store/".$pg->slug."</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.51</priority>\n</url>";}
  foreach ($scs as $sc) {$subs .= "<url>\n<loc>https://sade.store/subcategory/".$sc->slug."</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.52</priority>\n</url>";}
  foreach ($cts as $ct) {$cats .= "<url>\n<loc>https://sade.store/category/".$ct->slug."</loc>\n<lastmod>".$date."T18:49:36+00:00</lastmod>\n<priority>0.53</priority>\n</url>";}
  $main = "<?xml version='1.0' encoding='UTF-8'?>\n<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'\n xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'\n xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 \n http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>".$home."\n".$all_news."\n".$check."\n".$contact."\n".$acc."\n".$pros."\n".$news."\n".$pages."\n".$subs."\n".$cats."\n</urlset>";
  file_put_contents('../../public/sitemap.xml', $main);
  // echo "<pre>".file_get_contents("../../public/sitemap.xml");
}

function isJson($string) {
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}
?>
