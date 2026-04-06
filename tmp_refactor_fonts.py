import os
import re

css_dir = r"d:\Project Laravel\arh_web\resources\css"

def get_fs_var(px):
    if px <= 12: return 'var(--fs-xs)'
    if px <= 14: return 'var(--fs-sm)'
    if px <= 16.5: return 'var(--fs-base)'
    if px <= 19: return 'var(--fs-md)'
    if px <= 21: return 'var(--fs-lg)'
    if px <= 26: return 'var(--fs-xl)'
    if px <= 34: return 'var(--fs-2xl)'
    return 'var(--fs-3xl)'

def process_file(filepath):
    # Do not convert these base files
    if "fonts.css" in filepath or "typography.css" in filepath:
        return
        
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
        
    def repl(m):
        val = float(m.group(1))
        unit = m.group(2)
        if unit == 'rem':
            px = val * 16
        elif unit == 'em':
            px = val * 16
        elif unit == 'px':
            px = val
        else:
            return m.group(0) # skip
            
        return f"font-size: {get_fs_var(px)};"

    # Match font-size: Xpx; or font-size: Xrem; handles whitespaces
    new_content = re.sub(r'font-size:\s*([0-9.]+)(px|rem|em);', repl, content)
    
    if new_content != content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Updated: {filepath}")

for root, dirs, files in os.walk(css_dir):
    for f in files:
        if f.endswith(".css"):
            process_file(os.path.join(root, f))
