var input = [1, 0, 0, 3, 1, 1, 2, 3, 1, 3, 4, 3, 1, 5, 0, 3, 2, 1, 9, 19, 1, 19, 5, 23, 1, 13, 23, 27, 1, 27, 6, 31, 2, 31, 6, 35, 2, 6, 35, 39, 1, 39, 5, 43, 1, 13, 43, 47, 1, 6, 47, 51, 2, 13, 51, 55, 1, 10, 55, 59, 1, 59, 5, 63, 1, 10, 63, 67, 1, 67, 5, 71, 1, 71, 10, 75, 1, 9, 75, 79, 2, 13, 79, 83, 1, 9, 83, 87, 2, 87, 13, 91, 1, 10, 91, 95, 1, 95, 9, 99, 1, 13, 99, 103, 2, 103, 13, 107, 1, 107, 10, 111, 2, 10, 111, 115, 1, 115, 9, 119, 2, 119, 6, 123, 1, 5, 123, 127, 1, 5, 127, 131, 1, 10, 131, 135, 1, 135, 6, 139, 1, 10, 139, 143, 1, 143, 6, 147, 2, 147, 13, 151, 1, 5, 151, 155, 1, 155, 5, 159, 1, 159, 2, 163, 1, 163, 9, 0, 99, 2, 14, 0, 0]

function GravityAssist(intCodeProgram: Array<number>) : Array<number> {
    let currPos = 0;
    while (currPos <= intCodeProgram.length) {
        let opCode = intCodeProgram[currPos];
        let intA = intCodeProgram[currPos + 1];
        let intB = intCodeProgram[currPos + 2];
        let storePos = intCodeProgram[currPos + 3];

        switch (opCode) {
            case 1:
                intCodeProgram[storePos] = intCodeProgram[intA] + intCodeProgram[intB];
                break;
            case 2:
                intCodeProgram[storePos] = intCodeProgram[intA] * intCodeProgram[intB];
                break;
            case 99:
                return intCodeProgram;
            default:
                throw "Unknown Opcode";
        }
        currPos = currPos + 4;
    }
    return intCodeProgram;
}

function assertArrayIsEqual (arrayA, arrayB) {
    // if the other array is a falsy value, return
    if (!arrayB)
        return false;

    // compare lengths - can save a lot of time 
    if (arrayA.length != arrayB.length)
        return false;

    for (var i = 0, l=arrayA.length; i < l; i++) {
        // Check if we have nested arrays
        if (arrayA[i] instanceof Array && arrayB[i] instanceof Array) {
            // recurse into the nested arrays
            if (!arrayA[i].equals(arrayB[i]))
                return false;       
        }           
        else if (arrayA[i] != arrayB[i]) { 
            // Warning - two different object instances will never be equal: {x:20} != {x:20}
            return false;   
        }           
    }       
    return true;
}

// Hide method from for-in loops
Object.defineProperty(Array.prototype, "equals", {enumerable: false});
function TestGravityAssist() {    
    /*    1,0,0,0,99 becomes 2,0,0,0,99 (1 + 1 = 2). */
    let test: Array<number> = [];
    test = GravityAssist([1,0,0,0,99]);
    if (!assertArrayIsEqual(test, [2,0,0,0,99])) {
        console.error('Test 1 failed');
        console.log(test);
    }
    /*    2,3,0,3,99 becomes 2,3,0,6,99 (3 * 2 = 6). */
    test = GravityAssist([2,3,0,3,99]);
    if (!assertArrayIsEqual(test, [2,3,0,6,99])) {
        console.error('Test 2 failed');
        console.log(test);
    }    
    /*    2,4,4,5,99,0 becomes 2,4,4,5,99,9801 (99 * 99 = 9801). */
    test = GravityAssist([2,4,4,5,99,0]);
    if (!assertArrayIsEqual(test, [2,4,4,5,99,9801])) {
        console.error('Test 3 failed')
        console.log(test);
    }    
    /*    1,1,1,4,99,5,6,0,99 becomes 30,1,1,4,2,5,6,0,99. */
    test = GravityAssist([1,1,1,4,99,5,6,0,99]);
    if (!assertArrayIsEqual(test, [30,1,1,4,2,5,6,0,99])) {
        console.error('Test 4 failed')
        console.log(test);
    }
}

TestGravityAssist();
//before running the program, replace position 1 with the value 12 and replace position 2 with the value 2.
input[1] = 12;
input[2] = 2;
let result = GravityAssist(input);
console.log('Value at postion 0: ', result[0]);