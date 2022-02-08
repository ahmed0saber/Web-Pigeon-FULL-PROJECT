/*  FAV or REC  */
function show_fav(){
    document.getElementsByClassName('messages-container')[0].style.display = 'none';
    document.getElementsByClassName('fav-messages-container')[0].style.display = 'flex';
}
function show_rec(){
    document.getElementsByClassName('fav-messages-container')[0].style.display = 'none';
    document.getElementsByClassName('messages-container')[0].style.display = 'flex';
}