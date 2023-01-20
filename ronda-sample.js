/* ronda-sample.js */

/* prepare ronda data */
var RONDA_DATA={
    "title": "Jadwal Ronda - Kp. <kampung>, RT. 00/00, Kel. <kelurahan>",
    "startDate": "2015-05-01", // string of starting date; date format must be yyyy-mm-dd
    "perTeam": 4,              // int of member per team
    "repeat": 5,               // int of repeatation schedule
    "random": false,           // boolean of randomize; WARNING: with this option set TRUE,
                               // this must be generate ONCE, because next generate will be different
    "members": [               // array of list of participants
        "Dheni Oslan",
        "Abd. Latief",
        "Jansir Winto S.",
        "Sarmono",
        "B. Marpaung",
        "Harsono",
        "Yunanto/Surya",
        "Herriyandi",
        "Purwanto",
        "Firdaus",
        "Djoko Suroyono",
        "Ahmad Madun",
        "Seto B.W.",
        "Julianto",
        "Asbirul HS",
        "Manurung",
        "David",
        "Iwan/Depan",
        "Ahmad Robani",
        "Jack/Ria",
        "Hisna Hendriks",
        "Praditya Erlangga",
        "Andrie",
        "Untung/Zaenal",
        "Mumuk/Kiki",
        "F. Mangunsong",
        "Sutedjo Prasetyo",
        "Abu Ayyub",
        "Marulloh",
        "Ali Mukti M.",
        "Suryadi",
        "Olfie/Eko",
        "Ahmad/Sumi",
        "Bambang/Julio",
        "Iman/Nasam",
        "Zaky Putra Ali",
        "Arfah Shafri",
        "H. Alief R.",
        "Setyo S.",
        "Ary/Service TV",
        "Dede Iskandar",
        "Abd. Fatoni",
        "Saifur Triyanto",
        "Dr. Iwan",
        "Anton",
        "Sugito",
        "Abdul Haris",
        "Edison",
        "Ponirun Popon",
        "Joko Suseno",
        "Moko/Untung",
        "Suwandi",
        "Arifin",
        "Oman",
        "Bariun",
        "Ma'ad",
        "Yanto/Kus",
        "Sutomo",
        "Purwadji",
        "Suwarno",
        "Suheri",
        "Maryadi",
        "Samudji",
        "Janjang H.",
        "Budi Santoso",
        "Ngadisan",
        "Bambang SM.",
        "Elan Suherlan",
        "Saifur Triyono",
        "Somad",
        "Sardi",
        "Zakiyah/Suryo",
        "Samsudin",
        "Adji/Kasim",
        "Usman/Fadil",
        "H. Solihin",
        "Muhammad/Daud",
        "Senan",
        "Joni Utomo",
        "Hadi S.",
        "Pakde Diro",
        "Irwan",
        "Kartiman",
        "Sunarto",
        "Tribayu",
        "Tarmudji",
        "Herbert N.",
        "Budi Setiawan",
        "Abd. Rahman Wahid",
        "Suwarno/Agung",
        "Ahmad/Suri",
        "Tarsono",
        "Rully",
        "Maman",
        "Jimmy/Puput",
        "Hamdanih",
        "Tri Mulyono",
        "Adi Suryana",
        "Fernando",
        "Ai Maidi"
    ]
};

/* initialize ronda data, then put in #ronda element */
(new Ronda(RONDA_DATA)).put("#ronda");




