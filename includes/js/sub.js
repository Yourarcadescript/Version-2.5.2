var bad_words=['http','www','com','.com','html','href','url','viagra','online','cheap','zithromax','zoloft','geesworld','gmail','levitra','buy','lexapro','paxil','.html','shit','piss','fuck','cunt','motherfucker','tits','cocksucker','bastered','prick','asshole','ass','.http','.href','[url'];

function makeRegex(str){
var str=str.toLowerCase(), regx='\\b';
for (var i_tem = 0; i_tem < str.length; i_tem++)
regx+='['+str.charAt(i_tem)+str.charAt(i_tem).toUpperCase()+']';
return new RegExp(regx+'\\b');
}

for (var i_tem = 0; i_tem < bad_words.length; i_tem++)
bad_words[i_tem]=makeRegex(bad_words[i_tem]);

function noBad(el){
var subb=el.form.elements;
for (var i_tem = 0; i_tem < subb.length; i_tem++)
if(subb[i_tem].type&&subb[i_tem].type.toLowerCase()=='submit'){
subb=subb[i_tem];
break;
}
for (var i_tem = 0; i_tem < bad_words.length; i_tem++)
if(bad_words[i_tem].test(el.value)){
subb.disabled=1;
document.browse.reset();
alert('No Invalid Text Or URLs Allowed!')
return;
}
subb.disabled=0;
}
