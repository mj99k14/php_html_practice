const readline = require('readline');
const inp = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

let id = "admin";
let pw = "1234";

inp.question("아이디를 입력해주세요: ", find_id => {
    inp.question("비밀번호를 입력하세요: ", find_password => {
        const fid = find_id;
        const fipasword = find_password;

        if (fid !== id) {
            console.log("아이디가 다릅니다");
        } else if (fipasword !== pw) {
            console.log("비밀번호가 다릅니다");
        } else {
            console.log("로그인 성공!");
        }

        inp.close(); // 입력 종료!
    });
});
