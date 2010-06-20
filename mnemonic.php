<?php
function mnemonic($chars,$numbers) {
$letters = array(
0 => array('q','w','r','g','f','d','s','z','x','c','v'),
1 => array('u','i','o'),
2 => array('y','p','h','j','k','l','b','n','m'),
3 => array('e','a')
);

$digits = array(
0 => array('1','2','3','4','5','6'),
1 => array('7','8','9','0')
);

for ($i=0; $i<$chars; $i++) {
$pass .= $letters[$i % 4][array_rand($letters[$i % 4])];
}

$dirty_words = array('bob','con','cum','fod','fuc','fud','fuk','gal','gat','mal','mam','mar','mec','pat','peg','per','pic','pil','pit','put','rab','tar','tes','tet','tol','vac','images','js','css','Services');

foreach ($dirty_words as $dirty_word) {
 if (strpos($pass, $dirty_word) !== false) {
 return mnemonic($chars, $numbers);
 }
}

if ($numbers > 0) {
for ($i=0; $i<$numbers; $i++) {
$pass .= $digits[$i % 2][array_rand($digits[$i % 2])];
 }
}

return $pass;
}
//echo mnemonic(6,2);
?>
