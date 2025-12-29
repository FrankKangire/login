let tog = 1
let rollingSound = new Audio('rpg-dice-rolling-95182.mp3')
let winSound = new Audio('winharpsichord-39642.mp3')



let p1sum = 0
let p2sum = 0
let p3sum = 0
let p4sum = 0


function play(player, psum, num) {
	if(player == "p1"){
	p1sum = p1sum + num
	let sum = p1sum
	if (sum == 1) {
        document.getElementById(`${player}`).style.left = `-228px`
		
    }
	else if (sum == 2) {
        document.getElementById(`${player}`).style.left = `-158px`
		
    }
	else if (sum == 3) {
        document.getElementById(`${player}`).style.left = `-88px`
		
    }
	else if (sum == 4) {
        document.getElementById(`${player}`).style.left = `-20px`
    }
	else if (sum == 5) {
        document.getElementById(`${player}`).style.left = `49px`
    }
	else if(sum == 6){
		document.getElementById(`${player}`).style.left = `149px`
		
	}
	else if(sum == 7){
		document.getElementById(`${player}`).style.left = `149px`
		document.getElementById(`${player}`).style.top = `-34px`
	}
	else if(sum == 8){
		document.getElementById(`${player}`).style.left = `149px`
		document.getElementById(`${player}`).style.top = `-104px`
	}
	else if(sum == 9){
		document.getElementById(`${player}`).style.left = `149px`
		document.getElementById(`${player}`).style.top = `-171px`
	}
	else if(sum == 10){
		document.getElementById(`${player}`).style.left = `149px`
		document.getElementById(`${player}`).style.top = `-240px`
	}
	else if(sum == 11){
		document.getElementById(`${player}`).style.left = `149px`
		document.getElementById(`${player}`).style.top = `-311px`
	}
	else if(sum == 12){
		document.getElementById(`${player}`).style.left = `149px`
		document.getElementById(`${player}`).style.top = `-415px`
	}
	else if(sum == 13){
		document.getElementById(`${player}`).style.left = `50px`
		document.getElementById(`${player}`).style.top = `-415px`
	}
	else if(sum == 14){
		document.getElementById(`${player}`).style.left = `-20px`
		document.getElementById(`${player}`).style.top = `-415px`
	}
	else if(sum == 15){
		document.getElementById(`${player}`).style.left = `-88px`
		document.getElementById(`${player}`).style.top = `-415px`
	}
	else if(sum == 16){
		document.getElementById(`${player}`).style.left = `-158px`
		document.getElementById(`${player}`).style.top = `-415px`
	}
	else if(sum == 17){
		document.getElementById(`${player}`).style.left = `-228px`
		document.getElementById(`${player}`).style.top = `-415px`
	}
	else if(sum == 18){
		document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-415px`
	}
	else if(sum == 19){
		document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-311px`
	}
	else if (sum == 20) {
        document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-240px`
    }
	else if (sum == 21) {
        document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-171px`
    }
	else if (sum == 22) {
        document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-104px`
		
    }
	else if (sum == 23) {
        document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-34px`
		
    }
	else if (sum == 24) {
        document.getElementById(`${player}`).style.left = `-230px`
		document.getElementById(`${player}`).style.top = `-34px`
		
    }
	else if (sum == 25) {
        document.getElementById(`${player}`).style.left = `-152px`
		document.getElementById(`${player}`).style.top = `-27px`
    }
	else if(sum == 26){
		document.getElementById(`${player}`).style.left = `-88px`
		document.getElementById(`${player}`).style.top = `-27px`
		
	}
	else if(sum == 27){
		document.getElementById(`${player}`).style.left = `-25px`
		document.getElementById(`${player}`).style.top = `-27px`
	}
	else if(sum == 28){
		document.getElementById(`${player}`).style.left = `55px`
		document.getElementById(`${player}`).style.top = `-238px`
	}
	else if(sum == 29){
		document.getElementById(`${player}`).style.left = `52px`
		document.getElementById(`${player}`).style.top = `-320px`
	}
	else if(sum == 30){
		document.getElementById(`${player}`).style.left = `-25px`
		document.getElementById(`${player}`).style.top = `-325px`
	}
	else if(sum == 31){
		document.getElementById(`${player}`).style.left = `-88px`
		document.getElementById(`${player}`).style.top = `-320px`
	}
	else if(sum == 32){
		document.getElementById(`${player}`).style.left = `-156px`
		document.getElementById(`${player}`).style.top = `-320px`
	}
	else if(sum == 33){
		document.getElementById(`${player}`).style.left = `-236px`
		document.getElementById(`${player}`).style.top = `-110px`
	}
	}
	else if(player == "p2"){
	p2sum = p2sum + num
    let sum = p2sum
	if (sum == 1) {
        document.getElementById(`${player}`).style.left = `-228px`
		
    }
	else if (sum == 2) {
        document.getElementById(`${player}`).style.left = `-158px`
		
    }
	else if (sum == 3) {
        document.getElementById(`${player}`).style.left = `-88px`
		
    }
	else if (sum == 4) {
        document.getElementById(`${player}`).style.left = `-20px`
    }
	else if (sum == 5) {
        document.getElementById(`${player}`).style.left = `50px`
    }
	else if(sum == 6){
		document.getElementById(`${player}`).style.left = `148px`
		
	}
	else if(sum == 7){
		document.getElementById(`${player}`).style.left = `148px`
		document.getElementById(`${player}`).style.top = `-90px`
	}
	else if(sum == 8){
		document.getElementById(`${player}`).style.left = `148px`
		document.getElementById(`${player}`).style.top = `-158px`
	}
	else if(sum == 9){
		document.getElementById(`${player}`).style.left = `148px`
		document.getElementById(`${player}`).style.top = `-226px`
	}
	else if(sum == 10){
		document.getElementById(`${player}`).style.left = `148px`
		document.getElementById(`${player}`).style.top = `-298px`
	}
	else if(sum == 11){
		document.getElementById(`${player}`).style.left = `148px`
		document.getElementById(`${player}`).style.top = `-368px`
	}
	else if(sum == 12){
		document.getElementById(`${player}`).style.left = `148px`
		document.getElementById(`${player}`).style.top = `-474px`
	}
	else if(sum == 13){
		document.getElementById(`${player}`).style.left = `50px`
		document.getElementById(`${player}`).style.top = `-474px`
	}
	else if(sum == 14){
		document.getElementById(`${player}`).style.left = `-20px`;
		document.getElementById(`${player}`).style.top = `-474px`;
	}
	else if(sum == 15){
		document.getElementById(`${player}`).style.left = `-88px`
		document.getElementById(`${player}`).style.top = `-474px`
	}
	else if(sum == 16){
		document.getElementById(`${player}`).style.left = `-158px`
		document.getElementById(`${player}`).style.top = `-474px`
	}
	else if(sum == 17){
		document.getElementById(`${player}`).style.left = `-228px`
		document.getElementById(`${player}`).style.top = `-474px`
	}
	else if(sum == 18){
		document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-474px`
	}
	else if(sum == 19){
		document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-368px`
	}
	else if (sum == 20) {
        document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-298px`
    }
	else if (sum == 21) {
        document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-229px`
    }
	else if (sum == 22) {
        document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-162px`
		
    }
	else if (sum == 23) {
        document.getElementById(`${player}`).style.left = `-328px`
		document.getElementById(`${player}`).style.top = `-90px`
		
    }
	else if (sum == 24) {
        document.getElementById(`${player}`).style.left = `-230px`
		document.getElementById(`${player}`).style.top = `-90px`
		
    }
	else if (sum == 25) {
        document.getElementById(`${player}`).style.left = `-153px`
		document.getElementById(`${player}`).style.top = `-84px`
    }
	else if(sum == 26){
		document.getElementById(`${player}`).style.left = `-90px`
		document.getElementById(`${player}`).style.top = `-84px`
		
	}
	else if(sum == 27){
		document.getElementById(`${player}`).style.left = `-25px`
		document.getElementById(`${player}`).style.top = `-84px`
	}
	else if(sum == 28){
		document.getElementById(`${player}`).style.left = `55px`
		document.getElementById(`${player}`).style.top = `-294px`
	}
	else if(sum == 29){
		document.getElementById(`${player}`).style.left = `50px`
		document.getElementById(`${player}`).style.top = `-378px`
	}
	else if(sum == 30){
		document.getElementById(`${player}`).style.left = `-25px`
		document.getElementById(`${player}`).style.top = `-381px`
	}
	else if(sum == 31){
		document.getElementById(`${player}`).style.left = `-89px`
		document.getElementById(`${player}`).style.top = `-378px`
	}
	else if(sum == 32){
		document.getElementById(`${player}`).style.left = `-155px`
		document.getElementById(`${player}`).style.top = `-378px`
	}
	else if(sum == 33){
		document.getElementById(`${player}`).style.left = `-235px`
		document.getElementById(`${player}`).style.top = `-166px`
	}
	}
	else if(player == "p3"){
	p3sum = p3sum + num
    let sum = p3sum
	if (sum == 1) {
        document.getElementById(`${player}`).style.left = `-225px`
		
    }
	else if (sum == 2) {
        document.getElementById(`${player}`).style.left = `-155px`
		
    }
	else if (sum == 3) {
        document.getElementById(`${player}`).style.left = `-85px`
		
    }
	else if (sum == 4) {
        document.getElementById(`${player}`).style.left = `-15px`
    }
	else if (sum == 5) {
        document.getElementById(`${player}`).style.left = `55px`
    }
	else if(sum == 6){
		document.getElementById(`${player}`).style.left = `150px`
		
	}
	else if(sum == 7){
		document.getElementById(`${player}`).style.left = `150px`
		document.getElementById(`${player}`).style.top = `-145px`
	}
	else if(sum == 8){
		document.getElementById(`${player}`).style.left = `150px`
		document.getElementById(`${player}`).style.top = `-215px`
	}
	else if(sum == 9){
		document.getElementById(`${player}`).style.left = `150px`
		document.getElementById(`${player}`).style.top = `-285px`
	}
	else if(sum == 10){
		document.getElementById(`${player}`).style.left = `150px`
		document.getElementById(`${player}`).style.top = `-355px`
	}
	else if(sum == 11){
		document.getElementById(`${player}`).style.left = `150px`
		document.getElementById(`${player}`).style.top = `-425px`
	}
	else if(sum == 12){
		document.getElementById(`${player}`).style.left = `150px`
		document.getElementById(`${player}`).style.top = `-525px`
	}
	else if(sum == 13){
		document.getElementById(`${player}`).style.left = `50px`
		document.getElementById(`${player}`).style.top = `-525px`
	}
	else if(sum == 14){
		document.getElementById(`${player}`).style.left = `-20px`
		document.getElementById(`${player}`).style.top = `-525px`
	}
	else if(sum == 15){
		document.getElementById(`${player}`).style.left = `-90px`
		document.getElementById(`${player}`).style.top = `-525px`
	}
	else if(sum == 16){
		document.getElementById(`${player}`).style.left = `-160px`
		document.getElementById(`${player}`).style.top = `-525px`
	}
	else if(sum == 17){
		document.getElementById(`${player}`).style.left = `-230px`
		document.getElementById(`${player}`).style.top = `-525px`
	}
	else if(sum == 18){
		document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-525px`
	}
	else if(sum == 19){
		document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-425px`
	}
	else if (sum == 20) {
        document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-355px`
    }
	else if (sum == 21) {
        document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-285px`
    }
	else if (sum == 22) {
        document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-215px`
		
    }
	else if (sum == 23) {
        document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-148px`
		
    }
	else if (sum == 24) {
        document.getElementById(`${player}`).style.left = `-230px`
		document.getElementById(`${player}`).style.top = `-148px`
		
    }
	else if (sum == 25) {
        document.getElementById(`${player}`).style.left = `-150px`;
		document.getElementById(`${player}`).style.top = `-140px`;
    }
	else if(sum == 26){
		document.getElementById(`${player}`).style.left = `-90px`
		document.getElementById(`${player}`).style.top = `-140px`
		
	}
	else if(sum == 27){
		document.getElementById(`${player}`).style.left = `-25px`
		document.getElementById(`${player}`).style.top = `-140px`
	}
	else if(sum == 28){
		document.getElementById(`${player}`).style.left = `57px`
		document.getElementById(`${player}`).style.top = `-350px`
	}
	else if(sum == 29){
		document.getElementById(`${player}`).style.left = `50px`
		document.getElementById(`${player}`).style.top = `-430px`
	}
	else if(sum == 30){
		document.getElementById(`${player}`).style.left = `-25px`
		document.getElementById(`${player}`).style.top = `-435px`
	}
	else if(sum == 31){
		document.getElementById(`${player}`).style.left = `-90px`
		document.getElementById(`${player}`).style.top = `-430px`
	}
	else if(sum == 32){
		document.getElementById(`${player}`).style.left = `-155px`
		document.getElementById(`${player}`).style.top = `-430px`
	}
	else if(sum == 33){
		document.getElementById(`${player}`).style.left = `-235px`
		document.getElementById(`${player}`).style.top = `-222px`
	}
	}
	else if(player == "p4"){
	p4sum = p4sum + num
    let sum = p4sum
	if (sum == 1) {
        document.getElementById(`${player}`).style.left = `-228px`
		
    }
	else if (sum == 2) {
        document.getElementById(`${player}`).style.left = `-158px`
		
    }
	else if (sum == 3) {
        document.getElementById(`${player}`).style.left = `-88px`
		
    }
	else if (sum == 4) {
        document.getElementById(`${player}`).style.left = `-20px`
    }
	else if (sum == 5) {
        document.getElementById(`${player}`).style.left = `50px`
    }
	else if(sum == 6){
		document.getElementById(`${player}`).style.left = `150px`;
		
	}
	else if(sum == 7){
		document.getElementById(`${player}`).style.left = `150px`;
		document.getElementById(`${player}`).style.top = `-200px`;
	}
	else if(sum == 8){
		document.getElementById(`${player}`).style.left = `150px`;
		document.getElementById(`${player}`).style.top = `-270px`;
	}
	else if(sum == 9){
		document.getElementById(`${player}`).style.left = `150px`;
		document.getElementById(`${player}`).style.top = `-340px`;
	}
	else if(sum == 10){
		document.getElementById(`${player}`).style.left = `150px`;
		document.getElementById(`${player}`).style.top = `-410px`;
	}
	else if(sum == 11){
		document.getElementById(`${player}`).style.left = `150px`;
		document.getElementById(`${player}`).style.top = `-480px`;
	}
	else if(sum == 12){
		document.getElementById(`${player}`).style.left = `150px`;
		document.getElementById(`${player}`).style.top = `-580px`
	}
	else if(sum == 13){
		document.getElementById(`${player}`).style.left = `55px`;
		document.getElementById(`${player}`).style.top = `-580px`;
	}
	else if(sum == 14){
		document.getElementById(`${player}`).style.left = `-20px`
		document.getElementById(`${player}`).style.top = `-580px`
	}
	else if(sum == 15){
		document.getElementById(`${player}`).style.left = `-88px`
		document.getElementById(`${player}`).style.top = `-580px`
	}
	else if(sum == 16){
		document.getElementById(`${player}`).style.left = `-158px`
		document.getElementById(`${player}`).style.top = `-580px`
	}
	else if(sum == 17){
		document.getElementById(`${player}`).style.left = `-228px`;
		document.getElementById(`${player}`).style.top = `-580px`;
	}
	else if(sum == 18){
		document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-580px`
	}
	else if(sum == 19){
		document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-480px`
	}
	else if (sum == 20) {
        document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-410px`
    }
	else if (sum == 21) {
        document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-340px`
    }
	else if (sum == 22) {
        document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-270px`
		
    }
	else if (sum == 23) {
        document.getElementById(`${player}`).style.left = `-330px`
		document.getElementById(`${player}`).style.top = `-200px`
		
    }
	else if (sum == 24) {
        document.getElementById(`${player}`).style.left = `-225px`
		document.getElementById(`${player}`).style.top = `-208px`
		
    }
	else if (sum == 25) {
        document.getElementById(`${player}`).style.left = `-150px`;
		document.getElementById(`${player}`).style.top = `-200px`;
    }
	else if(sum == 26){
		document.getElementById(`${player}`).style.left = `-75px`
		document.getElementById(`${player}`).style.top = `-200px`
		
	}
	else if(sum == 27){
		document.getElementById(`${player}`).style.left = `-12px`
		document.getElementById(`${player}`).style.top = `-200px`
	}
	else if(sum == 28){
		document.getElementById(`${player}`).style.left = `65px`;
		document.getElementById(`${player}`).style.top = `-410px`;
	}
	else if(sum == 29){
		document.getElementById(`${player}`).style.left = `50px`
		document.getElementById(`${player}`).style.top = `-490px`
	}
	else if(sum == 30){
		document.getElementById(`${player}`).style.left = `-25px`
		document.getElementById(`${player}`).style.top = `-490px`
	}
	else if(sum == 31){
		document.getElementById(`${player}`).style.left = `-90px`
		document.getElementById(`${player}`).style.top = `-490px`
	}
	else if(sum == 32){
		document.getElementById(`${player}`).style.left = `-155px`
		document.getElementById(`${player}`).style.top = `-490px`
		}
	else if(sum == 33){
		document.getElementById(`${player}`).style.left = `-235px`
		document.getElementById(`${player}`).style.top = `-280px`
	}
	}
	
    document.getElementById(`${player}`).style.transition = `linear all 0.5s`
}


document.getElementById("diceBtn").addEventListener("click", myFunction);
function myFunction() {
    rollingSound.play()
    num = Math.floor(Math.random() * (6 - 1 + 1) + 1)
    document.getElementById("dice").innerText = num
	
		if (tog % 4 == 1) {
			document.getElementById('tog').innerText = "Yellow's Turn"
			play('p1', 'p1sum', num)
		}
		else if (tog % 4 == 2) {
			document.getElementById('tog').innerText = "Green's Turn"

			play('p2', 'p2sum', num)
		}
		else if (tog % 4 == 3) {
			document.getElementById('tog').innerText = "Blue's Turn"

			play('p3', 'p3sum', num)
		}
		if (tog % 4 == 0) {
			document.getElementById('tog').innerText = "Red's Turn"

			play('p4', 'p4sum', num)
		}
		tog = tog + 1
}