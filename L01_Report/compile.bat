@echo off
echo Compiling LaTeX document...
pdflatex -interaction=nonstopmode main.tex

echo.
echo First compilation done. Running again for cross-references...
pdflatex -interaction=nonstopmode main.tex

echo.
echo Compilation complete! Opening PDF...
start main.pdf

pause
