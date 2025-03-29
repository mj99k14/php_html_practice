const readline = require('readline');

const q = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

let menu = () => {
    console.log('1. 덧셈');
    console.log('2. 뺄셈');
    console.log('3. 곱셈');
    console.log('4. 나눗셈');
};

// 메뉴 출력
menu();

// 메뉴 선택
q.question("메뉴를 선택하세요: ", (choice) => { //출력할 문구, 사용자가 입력할 값
    const selected = Number(choice); // 문자열로 숫자로바꾸는거

    // 메뉴 번호가 유효한지 확인
    if (selected < 1 || selected > 4) {
        console.log("잘못된 선택입니다. 프로그램을 종료합니다.");
        q.close();
        return;
    }

    // 첫 번째 숫자 입력
    q.question("첫 번째 숫자를 입력하세요: ", (one) => { //출력할 문구 사용자가 입력할 값값
        // 두 번째 숫자 입력
        q.question("두 번째 숫자를 입력하세요: ", (two) => {
            const a = Number(one);
            const b = Number(two);

            switch (selected) {
                case 1:
                    console.log(`결과: ${a + b}`);
                    break;
                case 2:
                    console.log(`결과: ${a - b}`);
                    break;
                case 3:
                    console.log(`결과: ${a * b}`);
                    break;
                case 4:
                    if (b === 0) {
                        console.log("0으로 나눌 수 없습니다.");
                    } else {
                        console.log(`결과: ${a / b}`);
                    }
                    break;
                default:
                    console.log("잘못된 입력입니다.");
                    break;
            }

            q.close(); // 모든 입력 후 종료
        });
    });
});
