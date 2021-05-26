import sys

equilavent_code = {
    '>': 'ptr += 1',
    '<': 'ptr -= 1',
    '+': 'memory[ptr] += 1',
    '-': 'memory[ptr] -= 1',
    '.': 'print(chr(memory[ptr]), end="")',
    ',': 'memory[ptr] = ord(sys.stdin.read(1))',
    '[': 'while memory[ptr] != 0:'
}

allowed_symbols = ['>', '<', '+', '-', '.', ',', '[', ']']


def is_symboll_allowed(symbol: chr) -> bool:
    return symbol in allowed_symbols

def print_line_with_ident(content: str, ident: int):
    print("\t" * ident, end="")
    print(content)

def print_initial_code():
    print("import sys\n")
    print("def main():")
    print("\tmemory = [0] * 5000")
    print("\tptr = 0")

def print_end_code():
    print("")
    print('if __name__ == "__main__":')
    print("\tmain()")

def main():
    if len(sys.argv) == 1:
        print("bf_to_python [file]")
        return

    file = open(sys.argv[1], 'r').read()

    print_initial_code()

    ident_cont = 1

    for symbol in file:
        if not is_symboll_allowed(symbol):
            continue
            
        if symbol == ']':
            ident_cont -= 1
            continue

        print_line_with_ident(equilavent_code[symbol], ident_cont)

        if symbol == '[':
            ident_cont += 1

    print_end_code()

if __name__ == "__main__":
    main()