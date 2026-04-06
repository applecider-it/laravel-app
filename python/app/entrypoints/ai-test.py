import os
import cv2

from app.services.ai.generate import generate_text
from app.services.ai.image_analysis import exec_image_analysis

def exec_test():
  print("begin exec_test")

  path = "./tmp/image.jpg"

  if not os.path.exists(path):
      print(f"{path}がありません。")
      return

  # 画像読み込み
  img = cv2.imread(path)

  print(exec_image_analysis(img))

exec_test()