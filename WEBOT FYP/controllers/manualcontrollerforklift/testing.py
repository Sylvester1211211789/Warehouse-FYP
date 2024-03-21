import os
import qrcode

def generate_qr(id, product):
    name = "PLT-1"
    qr = qrcode.QRCode(
        version=1,
        error_correction=qrcode.constants.ERROR_CORRECT_L,
        box_size=10,
        border=4,
    )

    data = name
    dat = name + ".png"
    qr.add_data(data)
    qr.make(fit=True)
    img = qr.make_image(fill_color="black", back_color="white")
    gg = img.save(dat)
    print(f"QR code image saved to: {gg}")


generate_qr(1,1)