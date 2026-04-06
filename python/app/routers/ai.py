from fastapi import APIRouter, File, UploadFile
import numpy as np
import cv2

from app.models.request import RequestData
from app.services.ai.ai_model import process_text
from app.services.ai.image_analysis import exec_image_analysis

router = APIRouter()

@router.post("/predict")
async def predict(data: RequestData):
    result = process_text(data.text)
    return {"result": result, "text": data.text}

@router.post("/detect")
async def detect(file: UploadFile = File(...)):
    # 画像読み込み（バイト → numpy）
    contents = await file.read()
    np_arr = np.frombuffer(contents, np.uint8)
    img = cv2.imdecode(np_arr, cv2.IMREAD_COLOR)

    result = exec_image_analysis(img)

    return {"result": result}
