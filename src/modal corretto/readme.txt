Ho fuso il css del modal e quello del menu in un unico file "mix.css", per togliere tutti i conflitti.
Tuttavia ho delimitato le due parti con un commento  (/* ##### FINE MENU, INIZIO MODAL #####*/), in caso si voglia mettere il css del modal a parte.

Ho dovuto modificare l'html, rinominando le classi del modal come segue

card-container  ---> mod-cad-container
card            ---> mod-card
card-img        ---> mod-card-img
card-body       ---> mod-card-body
card-title      ---> mod-card-title
card-text       ---> mod-card-text


ovviamente le immagini non vanno perchè il percorso non è giusto.
