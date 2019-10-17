/* ronda.js
 * ~ the schedule of Neighborhood Security System (NSS)
 * ~ base on Indonesia's Siskamling (Sistim keamanan lingkungan)
 * authored by 9r3i
 * https://github.com/9r3i
 * started at october 15th 2019
 * ~ version 1.0.0-stable in php version --> https://github.com/9r3i/ronda/tree/1.0.0-stable
 * ~ this is version 2.0.0 in javascript
 * @usage: (new ronda(RONDA_DATA)).put('#selector');
 */
;var ronda=window.ronda||function(data){
this.version='2.0.0'; // version of ronda; initial is 2.0.0; version 1.0.0-stable is php version
this.startTime=(new Date).getTime(); // starting time of first team
this.perTeam=4;     // int of maximum member per team
this.members=[];    // array of member names
this.teams=[];      // array of members classified by team; auto-generate using per team
this.random=false;  // bool of randomize members in team
this.repeat=5;      // int of repeat schedule for each team
this.title='Ronda'; // string of ronda title
/* put ronda schedule in document element
 * @parameter: id is string of selector; default: #ronda
 */
this.put=function(id){
  /* check selector id as string */
  if(typeof id!=='string'){return false;}
  /* get element using query selector */
  this.el=document.querySelector(id);
  if(!this.el){return false;}
  /* check the class, and add it if doesn't exist */
  if(!this.el.classList.contains('ronda')){
    this.el.classList.add('ronda');
  }this.el.innerHTML='';
  /* prepare body, header and footer */
  var header=document.createElement('div'),
      footer=document.createElement('div'),
      body=document.createElement('div');
  header.classList.add('ronda-header');
  footer.classList.add('ronda-footer');
  body.classList.add('ronda-body');
  header.innerText=this.title;
  footer.innerText='Copyright (c) 2019, Ronda version '+this.version+', ';
  footer.appendChild(this.presentedBy());
  /* prepare current team index and last team index */
  var tcurrent=this.config.current,
      tlast=(this.repeat*this.teams.length)+tcurrent,
      currentTime=this.config.now,
      rollingTime=24*3600*1000;
  /* start looping the team element */
  for(var i=tcurrent;i<tlast;i++){
    /* prepare team index */
    var tindex=i%this.teams.length;
    /* get team element data */
    var teamEl=this.buildTeamElement(tindex,currentTime);
    if(!teamEl){continue;}
    /* put element into ronda body */
    body.appendChild(teamEl);
    /* add current time from rollingTime */
    currentTime+=rollingTime;
  }
  /* append all created eleement to main element */
  this.el.appendChild(header);
  this.el.appendChild(body);
  this.el.appendChild(footer);
  /* write the title */
  var title=document.querySelector('title');
  if(!title){
    title=document.createElement('title');
    document.head.appendChild(title);
  }title.innerText=this.title;
  /* return this ronda element */
  return this.el;
};
this.buildTeamElement=function(i,t){
  /* check index property */
  if(!this.teams.hasOwnProperty(i)){
    return false;
  }
  /* prepare team members */
  var member=this.teams[i];
  /* prepare require element */
  var team=document.createElement('div'),
      teamHead=document.createElement('div'),
      teamBody=document.createElement('div');
  /* adding classes */
  team.classList.add('ronda-each');
  teamHead.classList.add('ronda-each-head');
  teamBody.classList.add('ronda-each-body');
  /* append head and body to team */
  team.appendChild(teamHead);
  team.appendChild(teamBody);
  /* input each team member */
  for(var i=0;i<member.length;i++){
    var mem=document.createElement('div');
    mem.classList.add('ronda-each-member');
    mem.innerText=member[i];
    teamBody.appendChild(mem);
  }
  /* prepare day and date */
  var date=[
    this.timeToDay(t),
    this.timeToDate(t)
  ];
  /* input header text */
  teamHead.innerText=date.join('\r\n');
  /* return team element */
  return team;
};
/* initialize ronda object -- this is like constructor, but i choose this way, :D */
this.init=function(data){
  /* validate data input */
  data=typeof data==='object'&&data!==null?data:{};
  /* check start date for start time */
  if(data.hasOwnProperty('startDate')
    &&data.startDate.match(/^\d{4}\-\d{2}\-\d{2}$/)){
    this.startTime=(new Date(data.startDate)).getTime();
  }
  /* check data per team */
  if(data.hasOwnProperty('perTeam')
    &&typeof data.perTeam==='number'){
    this.perTeam=parseInt(data.perTeam);
  }
  /* check members data */
  if(data.hasOwnProperty('members')
    &&Array.isArray(data.members)){
    this.members=data.members;
  }
  /* check random statement */
  if(data.hasOwnProperty('random')
    &&typeof data.random==='boolean'){
    this.random=data.random;
  }
  /* check data repeat */
  if(data.hasOwnProperty('repeat')
    &&typeof data.repeat==='number'){
    this.repeat=parseInt(data.repeat);
  }
  /* check data title */
  if(data.hasOwnProperty('title')
    &&typeof data.title==='string'){
    this.title=data.title;
  }
  /* add meta data */
  this.metaAuthor();
  /* then finally parse members data */
  return this.parse();
};
/* parse */
this.parse=function(r){
  /* prepare new members variables,
   * join and re-split to array, to prevent origin object value
   */
  var g=this.members.join('\r\n').split(/\r\n|\r|\n/);
  if(this.random){g=this.shuffle(g);}
  /* get team members */
  while(g.length>0){
    this.teams.push(g.splice(0,this.perTeam));
  }
  /* calculate new start date */
  var d=this.startTime,
      m=new Date,
      n=(new Date(m.getFullYear(),m.getMonth(),m.getDate())).getTime(),
      t=Math.ceil(this.members.length/this.perTeam), // equal to this.teams.length
      ph=3600*24*1000,       // a day in time
      h=Math.ceil((n-d)/ph), // progress rolling teams
      w=h%t;                 // current team index
  this.config={
    start:d,    // time of start date
    now:n,      // time of now
    current:w,  // current team index
    team:t,     // count of teams, equal to this.teams.length
    roll:h,     // time in progress rolling teams
  };
  /* return this object */
  return this;
};
/* shuffle */
this.shuffle=function(r){
  if(!Array.isArray(r)){return false;}
  if(r.length==0){return r;}
  var c=r.length,t,x;
  while(c>0){
    x=Math.floor(Math.random()*c);
    c--;t=r[c];
    r[c]=r[x];
    r[x]=t;
  }return r;
};
/* meta author */
this.metaAuthor=function(){
  if(document.querySelector('meta[name="author"]')
    &&document.querySelector('meta[name="author-uri"]')){
    return false;
  }
  var author=document.createElement('meta');
  var uri=document.createElement('meta');
  author.name='author';
  author.content='9r3i';
  uri.name='author-uri';
  uri.content='https://github.com/9r3i';
  document.head.appendChild(author);
  document.head.appendChild(uri);
  return true;
};
/* presented by */
this.presentedBy=function(){
  var span=document.createElement('span');
  var an=document.createElement('a');
  span.innerText='Presented by ';
  span.appendChild(an);
  an.innerText='9r3i';
  an.title='9r3i';
  an.target='_blank';
  an.href='https://github.com/9r3i';
  return span;
};
/* time to date */
this.timeToDate=function(t){
  if(typeof t!=='number'){return false;}
  var d=new Date(t);
  var m=[
    'Januari','Februari','Maret','April',
    'Mei','Juni','Juli','Agustus',
    'September','Oktober','November','Desember'
  ];
  return d.getDate()+' '+m[d.getMonth()]+' '+d.getFullYear();
};
/* time to day */
this.timeToDay=function(t){
  if(typeof t!=='number'){return false;}
  var d=new Date(t);
  var h=['Ahad','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu'];
  return h[d.getDay()];
};
/* initial the ronda */
return this.init(data);
};


