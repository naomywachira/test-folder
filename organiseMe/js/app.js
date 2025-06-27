// main stuff plus runtime initialisers

/*
	userid
	variable for projects saved
	variable for project_data
*/

var userid = '';
var uname = '';
var projects = [];
var project_name = '';
var curproject = 0;
var pdata = [];
var firstrun = true;
var lastid = 0;

// runtima data
var divider = '_#dvdr#_';
var loadtime = 1200;

// UI
var u_Text = document.querySelector('.uname');
var project_Summ = document.querySelector('.projectsummary');
var project_Text = document.querySelectorAll('.projectname');
var project_Progress = document.querySelectorAll('.project_progress');

// extras
var swmode = document.querySelector('[data-switchmode]');
var timebox = document.querySelector('.timebox');

var holder = document.querySelector('.content');
var popups = document.querySelector('.popups');
var adders = popups.querySelectorAll('.adder');
var switchers = popups.querySelectorAll('.switcher');

function setupEverything() {
	if(!checkItem('Orme_cur_userid')){
		// let con = confirm('would you like to create the default setup?');

		let con = true;
		if(con){
			handlemenu('s_users',true);
		} else {
			meknewID();
			alert('new user created, reload');
			window.location.reload();
		}
	} else {
		getstuff();
		renderdash();
	}
}

function getstuff() {
	let payld = localStorage.getItem('Orme_cur_userid');
	let tdata = payld.split('|');

	userid = tdata[1];
	uname = tdata[0];

	let myprojects = localStorage.getItem(`Orme_${userid}_projects`);

	if(myprojects != null){
		projects = myprojects.split('|');
		curproject = localStorage.getItem(`Orme_${userid}_curproject`);
		project_name = projects[Number(curproject)];

		// alert(`looking for [Orme_${userid}_project_${curproject}]`);
		pdata = readJSON(localStorage.getItem(`Orme_${userid}_project_${curproject}`));

		if(pdata == null){pdata = [];}
	}
}

// update ui accordingly
function updateUI() {
	// update navbar
	u_Text.innerHTML = `${uname}`;

	project_Text.forEach(el => {
		el.innerHTML = projects[Number(curproject)];
	});

	setTimeout( () => {
		// calculate project progress
		let items = document.querySelectorAll('[data-role=process]');
		let total = 0;
		let current = 0;
		let processes = [0,0];

		items.forEach(el => {
			let myitems = el.dataset.items;
			let done = el.dataset.done;

			console.log(myitems,done);
			total += Number(myitems);
			current += Number(done);

			processes[0] += 1;
			processes[1] += el.dataset.progress == '100' ? 1 : 0;
		});

		let progress = 0;

		if(current > 0 && total > 0){
			progress = (current / total) *100
		}

		project_Progress.forEach(el => {
			let rs = '';

			if(progress >= 100){
				rs = 'COMPLETE';
			} else if(progress == 0){
				rs = 'NOT STARTED';
			}else{
				if(el.dataset.toshow == 'true'){
					rs = `[${roundDP(current,0)}/${roundDP(total,0)}] ${roundDP(progress,3)}%`;
				} else if(el.dataset.toshow == 'items'){
					rs = `[${roundDP(current,0)}/${roundDP(total,0)}]`;
				}else {
					rs = `${roundDP(progress,2)}%`;
				}
			}

			el.innerHTML = rs;
		});

		// update the pdata too
		let myobj = {type: 'data','progress': progress,'myname':project_name};
		let found = 0,theid = 0;

		pdata.forEach((el,id) => {
			if(el.type == 'data'){
				found += 1;
				theid = id;
			}
		});

		if(found == 0){
			pdata.push(myobj)
		} else {
			pdata[theid] = myobj;
		}

		// update project summary
		project_Summ.innerHTML = `
				you have <b>${processes[0]}</b> ${plural('process',processes[0])}. <b>${processes[1]}</b> ${plural('is',processes[1])} complete<br>
				you have <b>${total}</b> total ${plural('task',total)}.<br>
				you have <b>${current}</b> ${plural('task',current)} complete.<br>
				you have <b>${total - current}</b> ${plural('task',(total - current))} remaining<br>
		`;

		// update all progress bars
		let thabars = document.querySelectorAll('.progress');

		thabars.forEach((e,id) => {
			let bar = e.querySelector('.bar');
			let w = e.dataset.val == '' ? Math.random() * 100 : e.dataset.val;

			bar.animate([
				{opacity: 1,width:'0'},
				{opacity: 1,width:`${w}%`}
			],{
				duration: 400,
				fill: 'forwards',
				easing: 'ease-out'
			})
		})

		// alert('done updating UI');

		// check if the pdata is read only
		found = 0;
		let rr = '';

		pdata.forEach((el,id) => {
			if(el.type == 'data'){
				found += 1;
				theid = id;
			}
		})

		// update content accordingly
		if(found != 0){
			if(pdata[theid].hasOwnProperty('readonly')){
				rr = pdata[theid]['readonly'] == 'yes' ? '' : 'readonly';

				holder.className = `content ${rr}`;
			}
		}
	},loadtime + (loadtime * 0.3));
}

// for rendering the UI
function renderdash() {
	// alert('rendering stuff');
	holder.innerHTML = uiguy[`mekrando`]('loading your planboard ...');

	if(!firstrun){
		// in case it may get laggy, make a way to only update certain items
		// let tempm = [];
		// pdata.forEach(el => {})

		holder.innerHTML = uiguy.mekUI(pdata);
	} else {
		firstrun = false;
		setTimeout(() => {
			holder.innerHTML = uiguy.mekUI(pdata);
			loadtime = 200;
		},loadtime);
	}

	updateUI();
}

// for adding things
function addme(n){
	let m = n-1;

	adders.forEach(el => {el.style.display = 'none'});
	switchers.forEach(el => {el.style.display = 'none'});
	adders[m].style.display = 'block';
	toggleShowB('.popups','flex','none');
}

function addNote() {
	lastid = pdata.length - 1;
	let myform = adders[0];
	let myobj = {};

	let mtitle = myform.querySelector('input').value;
	let mtext = myform.querySelector('textarea').value;

	if(mtitle == '' || mtext == ''){
		alert('put all the info');
	} else {
		// alert('adding stuff');

		myobj.type = "note";
		myobj.title = `${mtitle}`;
		myobj.content = `${mtext}`;
		pdata.push(myobj);

		renderdash();
		toggleShowB('.popups','flex','none');
	}
}

function addList() {
	lastid = pdata.length - 1;
	let myform = adders[1];
	let myobj = {};

	let mtitle = myform.querySelector('input').value;

	if(mtitle == ''){
		alert('doing nothing');
	} else {
		// alert('doing stuff');

		myobj.title = mtitle;
		myobj.type = 'list';
		myobj.content = '';
		pdata.push(myobj);

		renderdash();
		toggleShowB('.popups','flex','none');
	}
}

function addPList() {
	lastid = pdata.length - 1;
	let myform = adders[2];
	let myobj = {};

	let mtitle = myform.querySelector('input').value;

	if(mtitle == ''){
		alert('provide a title');
	} else {
		// alert('doing stuff');

		myobj.title = mtitle;
		myobj.type = 'process list';
		myobj.content = '';
		pdata.push(myobj);

		renderdash();
		toggleShowB('.popups','flex','none');
	}
}

function editlist(n) {
	let litem = pdata[n];

	if(litem != undefined | litem.type == 'list' | litem.type == 'processlist'){
		let toadd = document.querySelector(`#newli${n}`);
		if(toadd.value != ''){
			if(!toadd.value.includes('|')){
				let thelist = litem.content == '' ? [] : litem.content.split(divider);
				let addme = `f|${toadd.value}`;
				thelist.push(addme);
				litem.content = thelist.join(divider);

				renderdash();
			} else {
				alert('ILLEGAL CHARACTER INCLUDED!\nremove it first');
			}
		} else {
			alert('type something first');
		}
	}
}

function submitme(r,n,x) {
	if(r.toLowerCase() == 'enter'){
		if(n == 'list'){
			editlist(x);
		}
	}
}

function markme(item) {
	let prefix = item.checked ? 't' : 'f';

	// 0 - l, 1 - itemid, 2 - listitem
	let pld = item.dataset.myid.split('_');
	let list = pdata[pld[1]];

	if(list != undefined | list.type == 'list' | list.type == 'process list'){
		// get list items
		let datatemp = list.content.split(divider);

		// get list stuff
		let thelist = datatemp;

		if(pld[2] < thelist.length){
			// get list item
			let item = thelist[pld[2]];
			// split
			let sp = item.split('|');
			sp[0] = prefix;
			let final = sp.join("|");

			thelist[pld[2]] = final;
			let templist = thelist.join(divider);

			list.content = templist;

			pdata[pld[1]] = list;

			renderdash();
		} else {
			alert('error marking your item')
		}
	} else {
		alert('error adding item')
	}
}

function deleteme(me) {
	// 0 - l, 1 - itemid, 2 - listitem
	let pld = me.dataset.myid.split('_');
	let list = pdata[pld[1]];

	if(list != undefined | list.type == 'list' | list.type == 'process list'){

		let con = confirm('are you sure?');

		if(con){
			// alert(`removing item number ${Number(pld[2]) + 1}`);

			let tmplist = list.content.split(divider);
			tmplist.splice(pld[2],1);

			list.content = tmplist.join(divider);

			renderdash();
		} else {
			// cancelled
		}
	} else {
		alert('error removing item')
	}
}

function savedata() {
	// figure out a way to alert the user before paranoia kicks in

	let mydata = JSON.stringify(pdata);
	localStorage.setItem(`Orme_${userid}_project_${curproject}`,mydata);

	renderdash();

	alert('data saved successfully');
}

function removeme(id) {
	// alert('this is my thing');

	if(id < pdata.length){
		let con = confirm(`are you sure you want to delete this ${pdata[id].type}`);

		if(con){
			pdata.splice(id,1);
			renderdash();
		}
	} else {
		alert('invalid ID')
	}
}

// for switching modes
function switchmode(what) {
	let htm = document.querySelector('html');
	let con = htm.dataset.mode.toLowerCase();

	if(what != undefined){
		con = (what) ? 'dark' : 'light';
	} else {
		// alert('changing');
	}

	let curmode = con;
	let themode = curmode == 'light' ? 'dark' : 'light';
	let theicon = curmode != 'light' ? 'fa-moon-o' : 'fa-sun-o';

	htm.dataset.mode = themode;
	swmode.innerHTML = `<i class="fa ${theicon}"></i> switch mode`;

	console.log(`switching to ${themode}`);
}

// creates a new user
function newuserInter(e) {
	if(e.key.toLowerCase() == 'enter'){
		// console.log(e);
		newuserOp();
	}
}

function newuserOp() {
	handlemenu('newuser',document.querySelector('#newuser').value);
}

// creates a new project
function newprojectInter(e) {
	if(e.key.toLowerCase() == 'enter'){
		// console.log(e);
		newprojectOp();
	}
}

function newprojectOp() {
	handlemenu('newproject',document.querySelector('#newproject').value);
}

// set a few UI based things (extras and helpers)
setTimeout(() => {
	let wcheck = document.querySelector('.widthcheck');

	if(holder != null && wcheck != null){
		let w = wcheck.offsetWidth;
		holder.style.columns = `${w}px`;
	}
},500);

// just hacks delete later
function meknewID(con) {
	// new user id payload
	let tname = `user [${mekRandomString(3)}]`;
	let tid = `${Math.floor(getRandom(34588,5999999999))}`;
	let pld = `${tname}|${tid}`;
	
	if(con != undefined){
		return pld;
	}

	// new default project
	localStorage.setItem(`Orme_${tid}_projects`,`default project`);
	localStorage.setItem(`Orme_${tid}_curproject`,0);
	localStorage.setItem(`Orme_${tid}_project_0`,`[]`);

	return null;
}

function clearEverything() {
	let con = confirm('this will delete every piece of data stored for this webapp. Are you sure?');

	if(con){
		for(let key in localStorage){
			if(key.toString().includes('Orme')){
				localStorage.removeItem(key);
				console.log(`removed [${key}]`);
			}
		}

		setTimeout(() => {
			window.location.reload();
		}, 100);
	}
}

function showAll() {
	for(let key in localStorage){
		if(key.toString().includes('Orme')){
			console.log(`${key} : ` + localStorage.getItem(key));
		}
	}
}

// -------------------------------------------------------------------------------------------------------------------

// time based ops
function mekTimebox() {
	timebox.className = 'timebox';

	const now = new Date();
	const currentTime = now.toLocaleTimeString();
	const currentDate = now.toLocaleDateString();

	timebox.innerHTML = `<b>${currentDate}</b> | <b>${currentTime}</b>`;
}

let timeinter = setInterval(() => {
	mekTimebox();
},500);

const now = new Date();
const currentHour = now.getHours();
const currentMinutes = now.getMinutes();

function isNightTime(hour, minutes) {
	const currentTimeInMinutes = hour * 60 + minutes;
	const startNight = 19 * 60 + 30; // 7:30 PM
	const endNight = 6 * 60 + 30; // 6:30 AM

	// Check if current time is within the range
	return currentTimeInMinutes >= startNight || currentTimeInMinutes < endNight;
}

switchmode(!isNightTime(currentHour, currentMinutes));

// menu operations

function export_planboard() {
	let con = confirm(`are you sure you want to export the planboard for ${project_name}`);

	
	if(con){
		let conw = confirm('do you want it to be readonly?');

		if(conw){
			found = 0;
			let rr = '';

			pdata.forEach((el,id) => {
				if(el.type == 'data'){
					el['readonly'] = 'yes';
				}
			});
		}
		const jsonString = JSON.stringify(pdata);
		const blob = new Blob([jsonString], { type: 'application/json' });

		const link = document.createElement('a');
		link.href = URL.createObjectURL(blob);
		link.download = `Orme_planboard [${project_name}] exported`;
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
	}
}

function handleImport() {
	let importOp = document.querySelector('#importop').value;
	let importFile = document.querySelector('#importfile');
	let myData = pdata;

	if (!importFile.files.length) {
		alert('Select a file first.');
		return;
	}

	const file = importFile.files[0];
	const reader = new FileReader();

	reader.onload = function (e) {
		const fileContent = e.target.result;
		newdata = JSON.parse(fileContent);

		console.log('before', pdata);
		console.log('importing',newdata,myData);

		if(importOp == 'append'){
			myData = pdata.concat(newdata);
			pdata = myData;
			console.log("lkdsfnjoleringinreks");
		} else {
			pdata = newdata;
			console.log("woodafuq");
		}
		
		console.log('after', pdata,myData);

		// savedata();

		// alert('planboard updated, reload required');

		// window.location.reload();
		renderdash();
		toggleShowB('.popups','flex','none');
	};

	reader.onerror = function () {
		console.error('Error reading file.');
	};

	reader.readAsText(file);
}

let menuop = {};

menuop['s_users'] = (e) => {
	// for switching users
	let userswitch = switchers[0];
	toggleShowB('.popups','flex','none');

	if(e == undefined){
		// nada
	} else {
		userswitch.querySelector('.w3-btn.w3-right').style.display = 'none';
	}

	adders.forEach(el => {
		el.style.display = 'none';
	});

	switchers.forEach(el => {
		el.style.display = 'none';
	});

	userswitch.style.display = 'block';

	// get the list of users
	let usersRaw = localStorage.getItem('Orme_users');

	// check localstorage, if not list only the current user
	if(usersRaw == null){
		usersRaw = '';
		// usersRaw = userid != '' ? `${uname}|${userid}${divider}` : `${meknewID(true)}${divider}`;
		// localStorage.setItem('Orme_users',usersRaw);
	}

	let users = usersRaw.split(divider);
	let listholder = userswitch.querySelector('.userlist');

	listholder.innerHTML = '';

	// render the list
	for (let x = 0; x < users.length; x++) {
		let element = users[x];
		if(element != ''){
			let li = document.createElement('li');
			li.className = "w3-hover-grey w3-bar-item";
			li.innerHTML = `${element.split('|')[0]}`;
			listholder.appendChild(li);

			li.addEventListener('click',() => {
				menuop.set_user(x);
			})
		}
	}
}

menuop['i_file'] = () => {
	addme(4);
}

menuop['e_file'] = () => {
	export_planboard(4);
}

menuop['s_projects'] = (e) => {
	let p_switch = switchers[1];
	p_switch.querySelector('.toptxt').innerHTML = `<b class="themetxt">${uname}</b> projects`

	// for switching projects
	if(e == undefined){
		toggleShowB('.popups','flex','none');
	} else {
		p_switch.querySelector('.w3-btn.w3-right').style.display = 'none';
	}

	adders.forEach(el => {
		el.style.display = 'none';
	});

	switchers.forEach(el => {
		el.style.display = 'none';
	});

	p_switch.style.display = 'block';

	let projectsRaw = localStorage.getItem(`Orme_${userid}_projects`);

	projectsRaw = projectsRaw == null ? '' : projectsRaw;

	let userprojs = projectsRaw.split('|');
	let listholder = p_switch.querySelector('.thelist');

	listholder.innerHTML = '';

	// render the list
	for (let x = 0; x < userprojs.length; x++) {
		let element = userprojs[x];
		if(element != ''){
			let li = document.createElement('li');
			li.className = "w3-hover-grey w3-bar-item";
			li.innerHTML = `${element.split('|')[0]}`;
			listholder.appendChild(li);

			li.addEventListener('click',() => {
				menuop.set_project(x);
			})
		}
	}
}

menuop['set_project'] = (e) => {
	// get users
	let myprojects = localStorage.getItem(`Orme_${userid}_projects`);

	myprojects = myprojects == null ? '' : myprojects;
	items = myprojects.split('|');

	if(e < items.length){
		alert(`new project ${e}`)
		localStorage.setItem(`Orme_${userid}_curproject`,e);
	}

	window.location.reload();
}

menuop['newproject'] = (e) => {
	if(e == ''){
		alert('provide a project name first');
	} else {
		alert(`adding new project : ${e}`);

		// get projects list
		let plist = localStorage.getItem(`Orme_${userid}_projects`);
		plist = plist == null ? '' : plist;
		let pname = `${e}`;

		if(!(plist.toLowerCase().includes(pname.toLowerCase()))){
			if(plist == ''){
				plist = pname;
			} else {
				plist += `|${pname}`;
			}

			// mek new project
			localStorage.setItem(`Orme_${userid}_projects`,plist);

			// get the latest id from projects list
			let newid = plist.split('|').length - 1;

			// make a blank pdata for the project
			localStorage.setItem(`Orme_${userid}_project_${newid}`,`[{"title":"main process","type":"process list","content":"f|add item here","cantdelete":true}]`);

			// set the current project to the latest id
			setTimeout(() => {
				menuop.set_project(newid);
			}, 100);
		} else {
			alert('a project already exists with that name, try another');
		}
	}
}

menuop['set_user'] = (e) => {
	console.log(e);

	// get users
	let users = localStorage.getItem('Orme_users').split(divider);
	// validate index
	if(e < users.length){
		// set current user to the index
		localStorage.setItem('Orme_cur_userid',users[e]);
		getstuff();
	}

	// open project switcher
	handlemenu('s_projects',users[e])
}

menuop['newuser'] = (e) => {
	console.log(e);

	if(e == ''){
		alert('provide a username first');
	} else {
		alert(`adding new user : ${e}`);

		// get users list
		let ulist = localStorage.getItem('Orme_users');
		let userpayload = `${e}|${mekRandomString(4)}${divider}`;

		if(ulist == null){
			ulist = '';
		}

		if(!(ulist.toLowerCase().includes(e.toLowerCase()))){
			// mek new user
			ulist += userpayload;
			localStorage.setItem('Orme_users',ulist);
			
			// get the latest id from users list
			let newid = ulist.split(divider).length - 2;

			// set the current user to the set id
			setTimeout(() => {
				menuop.set_user(newid);
			}, 100);
		} else {
			alert('user already exists, try another name')
		}
	}

}

function handlemenu(what,xtra) {
	if(xtra == undefined){
		toggleShow('#mySidebar');
	}

	if(menuop.hasOwnProperty(what)){
		if(xtra == undefined){
			menuop[what]();
		} else {
			menuop[what](xtra);
		}
	} else {
		alert('invalid menu op')
	}
}
