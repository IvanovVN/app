(function(w,d,s,p,v,e,r) {w['$igniter_var']=v;w[v]=w[v]||function(){(w[v].q=w[v].q||[]).push(
arguments)};w[v].l=1*new Date();e=d.createElement(s),r=d.getElementsByTagName(s)[0];e.async=1;
e.src=p+'?ts='+(+new Date()/3600000|0);
r.parentNode.insertBefore(e,r)})(window,document,'script','//cdn.fandommetrics.com/l9ehhrb6mtv75bp2.js','$p');

$p("init", "l9ehhrb6mtv75bp2", {
    config: {
        sdk: {
            queryServer: "//query.fandommetrics.com"
        },
        activity: {
            activityServer: "//api.fandommetrics.com"
        },
        inventory: {
            inventoryServer: "//api.fandommetrics.com"
        }
    }
});
$p("send", "pageview");
$p("setRequestFields", ["rank", "thumbnail", "title", "url", "presented_by", "author"]);
