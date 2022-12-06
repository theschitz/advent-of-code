use std::str::Split;

pub fn process_part1(input: &str) -> i32 {
    let measurments:i32 = 0;
    let list: Split<&str> = input.split("\n");
    for m in list {
        m
    }
    return measurments;
}

pub fn process_part2(input: &str) -> i32 {
    let mut measurments:i32 = 0;
    let result: Vec<&str> = input.split("\n").collect();
    let mut count = 0u32;
    loop {
        count += 1;
        if result[count] < result.iter().pos[count - 1] {
            measurments++;
        }

    }
    return measurments;
}

#[cfg(test)]
mod tests {
    use super::*;

    const INPUT: &str = "199
    200
    208
    210
    200
    207
    240
    269
    260
    263";

    #[test]
    fn it_works() {
        let result = process_part1(INPUT);
        assert_eq!(result, 7);
    }
}
