/*     THEMES     */
var current = 0;
var themes = [
    {
        "id": "1",
        "pri": "#F88F01",
        "font": "#f7f7f7",
        "background": "#080808",
        "nav": "#2b2b2b"
    },
    {
        "id": "2",
        "pri": "#8E05C2",
        "font": "#f7f7f7",
        "background": "#080808",
        "nav": "#2b2b2b"
    },
    {
        "id": "3",
        "pri": "#44e",
        "font": "#f7f7f7",
        "background": "#080808",
        "nav": "#2b2b2b"
    },
    {
        "id": "4",
        "pri": "#DA0037",
        "font": "#f7f7f7",
        "background": "#080808",
        "nav": "#2b2b2b"
    },
    {
        "id": "5",
        "pri": "#029A9A",
        "font": "#f7f7f7",
        "background": "#080808",
        "nav": "#2b2b2b"
    },
    {
        "id": "6",
        "pri": "#FF4C29",
        "font": "#f7f7f7",
        "background": "#080808",
        "nav": "#2b2b2b"
    },
    {
        "id": "7",
        "pri": "#CA3E47",
        "font": "#f7f7f7",
        "background": "#080808",
        "nav": "#2b2b2b"
    },
    {
        "id": "8",
        "pri": "#22f",
        "font": "#080808",
        "background": "#FAFAFA",
        "nav": "#e2e2e2"
    },
    {
        "id": "9",
        "pri": "#2b2",
        "font": "#080808",
        "background": "#FAFAFA",
        "nav": "#e2e2e2"
    },
    {
        "id": "10",
        "pri": "#e22",
        "font": "#080808",
        "background": "#FAFAFA",
        "nav": "#e2e2e2"
    }
];

if(localStorage.getItem("theme")){current = parseInt(localStorage.getItem("theme"));}else{current = 0;}
theme();

function theme(){
    document.querySelector(':root').style.setProperty('--pri',themes[current].pri);
    document.querySelector(':root').style.setProperty('--font',themes[current].font);
    document.querySelector(':root').style.setProperty('--background',themes[current].background);
    document.querySelector(':root').style.setProperty('--nav',themes[current].nav);
}
function changeTheme(){
    if(current==themes.length-1){current=0;}else{current+=1;}
    localStorage.setItem("theme", current);
    theme();
}